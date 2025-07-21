<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Showtime;
use App\Models\Seat;
use App\Models\Booking;
use App\Models\BookingSeat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ClientBookingController extends Controller
{
    public function loadSeatModal($showtimeId)
    {
        $showtime = Showtime::with(['movie', 'room.seats'])->findOrFail($showtimeId);

        $bookedSeatIds = BookingSeat::whereHas('booking', function ($q) use ($showtimeId) {
            $q->where('showtime_id', $showtimeId);
        })->pluck('seat_id')->toArray();

        $user = Auth::user();

        return view('client.booking.modal_content', compact('showtime', 'bookedSeatIds', 'user'));
    }


    public function storeBooking(Request $request, $showtimeId)
    {
        $request->validate([
            'seats' => 'required|array',
            'seats.*' => 'exists:seats,id',
        ]);

        $selectedSeatIds = $request->seats;

        // Lấy danh sách ghế đã đặt cho suất chiếu này
        $bookedSeatIds = BookingSeat::whereHas('booking', function ($q) use ($showtimeId) {
            $q->where('showtime_id', $showtimeId);
        })->pluck('seat_id')->toArray();

        // Kiểm tra nếu có ghế đã bị người khác đặt rồi
        $conflictedSeats = array_intersect($selectedSeatIds, $bookedSeatIds);

        if (count($conflictedSeats) > 0) {
            return redirect()->back()->withErrors(['seats' => 'Một số ghế bạn chọn đã có người đặt. Vui lòng chọn lại.']);
        }

        // Tạo booking
        $booking = Booking::create([
            'user_id' => Auth::id(),
            'showtime_id' => $showtimeId,
            'booking_time' => now(),
            'total_price' => 0, // bạn có thể tính tổng sau
        ]);

        foreach ($selectedSeatIds as $seatId) {
            BookingSeat::create([
                'booking_id' => $booking->id,
                'seat_id' => $seatId,
                'price' => 50000, // tuỳ ghế, bạn có thể tính theo loại
            ]);
        }

        return redirect()->route('client.home')->with('success', 'Đặt vé thành công!');
    }
}
