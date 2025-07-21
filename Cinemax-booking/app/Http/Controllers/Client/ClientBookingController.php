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

    
    public function storeBooking(Request $request)
    {
        // Validate dữ liệu
        $request->validate([
            'showtime_id' => 'required|exists:showtimes,id',
            'seat_ids' => 'required|array',
            'seat_ids.*' => 'exists:seats,id',
        ]);

        // Tạo booking
        $booking = Booking::create([
            'user_id' => Auth::id(),
            'showtime_id' => $request->showtime_id,
            'booking_time' => now(),
        ]);

        // Gán ghế cho booking
        foreach ($request->seat_ids as $seatId) {
            BookingSeat::create([
                'booking_id' => $booking->id,
                'seat_id' => $seatId,
            ]);
        }

        return redirect()->back()->with('success', 'Đặt vé thành công!');
    }
}
