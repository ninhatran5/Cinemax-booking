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

        // Truyền thông tin booking qua vnp_OrderInfo (json encode)
        $orderInfo = json_encode([
            'user_id' => Auth::id(),
            'showtime_id' => $showtimeId,
            'seat_ids' => $selectedSeatIds,
            'total_price' => $total,
            'booking_code' => $bookingCode,
        ]);

        // VNPay Config
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
            "vnp_OrderInfo" => $orderInfo,
            "vnp_OrderType" => "billpayment",
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $bookingCode,
        ];

        ksort($inputData);
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

        // Giải mã thông tin booking từ vnp_OrderInfo
        $orderInfo = json_decode($request->vnp_OrderInfo, true);

        if ($orderInfo && $secureHash === $request->vnp_SecureHash && $request->vnp_ResponseCode == '00') {
            // Kiểm tra lại ghế đã đặt chưa (tránh double booking)
            $alreadyBookedSeatIds = BookingSeat::whereIn('seat_id', $orderInfo['seat_ids'])
                ->whereHas('booking', function ($q) use ($orderInfo) {
                    $q->where('showtime_id', $orderInfo['showtime_id'])
                      ->where('payment_status', 'paid');
                })
                ->pluck('seat_id')
                ->toArray();
            if ($alreadyBookedSeatIds) {
                return redirect('/thanh-toan/that-bai')->withErrors(['seats' => 'Ghế đã đặt: ' . implode(', ', $alreadyBookedSeatIds)]);
            }
            // Tạo booking
            $booking = Booking::create([
                'user_id' => $orderInfo['user_id'],
                'showtime_id' => $orderInfo['showtime_id'],
                'booking_time' => now(),
                'total_price' => $orderInfo['total_price'],
                'order_code' => $orderInfo['booking_code'],
                'payment_status' => 'paid',
            ]);
            // Tạo booking_seat
            foreach ($orderInfo['seat_ids'] as $seatId) {
                $seat = Seat::with('type')->find($seatId);
                BookingSeat::create([
                    'booking_id' => $booking->id,
                    'seat_id' => $seatId,
                    'price' => $seat->type->price ?? 0,
                ]);
            }
            return redirect('/thanh-toan/thanh-cong/' . $booking->id);
        } else {
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
