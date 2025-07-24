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
        $showtime = Showtime::with(['room.seats.type'])->findOrFail($showtimeId);

        $bookedSeatIds = BookingSeat::whereHas('booking', function ($q) use ($showtimeId) {
            $q->where('showtime_id', $showtimeId);
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

        $bookedSeatIds = BookingSeat::whereHas('booking', function ($q) use ($showtimeId) {
            $q->where('showtime_id', $showtimeId);
        })->pluck('seat_id')->toArray();

        $conflictedSeats = array_intersect($selectedSeatIds, $bookedSeatIds);

        if (count($conflictedSeats) > 0) {
            return redirect()->back()->withErrors(['seats' => 'Một số ghế đã có người đặt. Vui lòng chọn lại.']);
        }

        $booking = Booking::create([
            'user_id' => Auth::id(),
            'showtime_id' => $showtimeId,
            'booking_time' => now(),
            'total_price' => 0,
        ]);

        $total = 0;

        foreach ($selectedSeatIds as $seatId) {
            $seat = Seat::with('type')->find($seatId);
            $price = $seat->type->price ?? 0;
            $total += $price;

            BookingSeat::create([
                'booking_id' => $booking->id,
                'seat_id' => $seatId,
                'price' => $price,
            ]);
        }

        $booking->update(['total_price' => $total]);
    }
}
