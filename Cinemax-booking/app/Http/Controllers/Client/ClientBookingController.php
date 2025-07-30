<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Showtime;
use App\Models\Seat;
use App\Models\Booking;
use App\Models\BookingSeat;
use App\Jobs\CancelPendingBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ClientBookingController extends Controller
{
    public function loadSeatModal($showtimeId)
    {
        $showtime = Showtime::with(['room.seats.type'])->findOrFail($showtimeId);

        // Chỉ lấy ghế đã thanh toán thành công (paid)
        $bookedSeatIds = BookingSeat::whereHas('booking', function ($q) use ($showtimeId) {
            $q->where('showtime_id', $showtimeId)
              ->where('payment_status', 'paid');
        })->pluck('seat_id')->toArray();

        return view('client.booking.modal', compact('showtime', 'bookedSeatIds'));
    }
    public function storeBooking(Request $request, $showtimeId)
    {
        $request->validate([
            'seats' => 'required|array',
            'seats.*' => 'exists:seats,id',
        ]);

        $selectedSeatIds = $request->seats;

        // Kiểm tra ghế đã đặt (chỉ kiểm tra ghế đã thanh toán thành công)
        $alreadyBookedSeatIds = BookingSeat::whereIn('seat_id', $selectedSeatIds)
            ->whereHas('booking', function ($q) use ($showtimeId) {
                $q->where('showtime_id', $showtimeId)
                  ->where('payment_status', 'paid');
            })
            ->pluck('seat_id')
            ->toArray();

        if ($alreadyBookedSeatIds) {
            $seatNames = Seat::whereIn('id', $alreadyBookedSeatIds)->pluck('name')->implode(', ');
            return redirect()->back()->withErrors(['seats' => 'Ghế đã đặt: ' . $seatNames])->withInput();
        }

        // Tính tổng tiền
        $total = 0;
        foreach ($selectedSeatIds as $seatId) {
            $seat = Seat::with('type')->find($seatId);
            $total += $seat->type->price ?? 0;
        }

        // Tạo mã đơn
        $bookingCode = 'CINEMAX' . strtoupper(uniqid());
        $booking = Booking::create([
            'user_id' => Auth::id(),
            'showtime_id' => $showtimeId,
            'booking_time' => now(),
            'total_price' => $total,
            'order_code' => $bookingCode,
            'payment_status' => 'pending',
        ]);

        foreach ($selectedSeatIds as $seatId) {
            $seat = Seat::with('type')->find($seatId);
            BookingSeat::create([
                'booking_id' => $booking->id,
                'seat_id' => $seatId,
                'price' => $seat->type->price ?? 0,
            ]);
        }

        // Dispatch job để hủy booking sau 3 phút nếu không thanh toán
        CancelPendingBooking::dispatch($booking->id)->delay(now()->addMinutes(3));

        // ✅ VNPay Config
        $vnp_TmnCode = config('vnpay.tmn_code');
        $vnp_HashSecret = config('vnpay.hash_secret');
        $vnp_Url = config('vnpay.url');
        $vnp_Returnurl = config('vnpay.return_url');

        $inputData = [
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $total * 100,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => now()->format('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $request->ip(),
            "vnp_Locale" => "vn",
            "vnp_OrderInfo" => "Thanh toan don hang " . $bookingCode,
            "vnp_OrderType" => "billpayment",
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $bookingCode,
        ];

        ksort($inputData);

        // Build hash string đúng chuẩn VNPay
        $query = [];
        foreach ($inputData as $key => $value) {
            if ($value !== null && $value !== '') {
                $query[] = urlencode($key) . '=' . urlencode($value);
            }
        }
        $hashData = implode('&', $query);

        $vnp_SecureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);

        $paymentUrl = $vnp_Url . '?' . implode('&', $query)
            . '&vnp_SecureHashType=SHA512&vnp_SecureHash=' . $vnp_SecureHash;

        Log::info('VNPay HashData: ' . $hashData);
        Log::info('VNPay SecureHash: ' . $vnp_SecureHash);
        Log::info('VNPay Payment URL: ' . $paymentUrl);
        Log::info('VNPay Input Data: ' . json_encode($inputData));

        return redirect($paymentUrl);
    }

    public function vnpayReturn(Request $request)
    {
        Log::info('VNPay Return Data: ' . json_encode($request->all()));
        
        $vnp_HashSecret = config('vnpay.hash_secret');
        $inputData = $request->except(['vnp_SecureHash', 'vnp_SecureHashType']);
        ksort($inputData);

        $query = [];
        foreach ($inputData as $key => $value) {
            if ($value !== null && $value !== '') {
                $query[] = urlencode($key) . '=' . urlencode($value);
            }
        }
        $hashData = implode('&', $query);

        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);

        Log::info('VNPay Return HashData: ' . $hashData);
        Log::info('VNPay Return SecureHash: ' . $secureHash);
        Log::info('VNPay Return Expected Hash: ' . $request->vnp_SecureHash);
        Log::info('VNPay Response Code: ' . $request->vnp_ResponseCode);

        $booking = Booking::where('order_code', $request->vnp_TxnRef)->first();

        if ($booking && $secureHash === $request->vnp_SecureHash && $request->vnp_ResponseCode == '00') {
            $booking->update(['payment_status' => 'paid']);
            return redirect('/thanh-toan/thanh-cong/' . $booking->id);
        } else {
            if ($booking) {
                $booking->update(['payment_status' => 'failed']);
            }
            return redirect('/thanh-toan/that-bai');
        }
    }

    public function history()
    {
        $bookings = Booking::where('user_id', Auth::id())
            ->with(['showtime.movie', 'showtime.room', 'bookingSeats.seat'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('client.history', compact('bookings'));
    }

    public function showBooking($bookingId)
    {
        $booking = Booking::where('id', $bookingId)
            ->where('user_id', Auth::id())
            ->with(['showtime.movie', 'showtime.room', 'bookingSeats.seat.type'])
            ->firstOrFail();

        return view('client.booking.show', compact('booking'));
    }
}
