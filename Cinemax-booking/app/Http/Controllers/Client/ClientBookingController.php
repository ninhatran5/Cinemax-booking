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

        // BƯỚC 1: kiểm tra các ghế đã được đặt chưa
        $alreadyBookedSeatIds = BookingSeat::whereIn('seat_id', $selectedSeatIds)
            ->whereHas('booking', function ($q) use ($showtimeId) {
                $q->where('showtime_id', $showtimeId);
            })
            ->pluck('seat_id')
            ->toArray();

        if (count($alreadyBookedSeatIds) > 0) {
            $seatNames = Seat::whereIn('id', $alreadyBookedSeatIds)
                ->pluck('name')
                ->implode(', ');

            return redirect()->back()->withErrors([
                'seats' => 'Các ghế sau đã có người đặt: ' . $seatNames . '. Vui lòng chọn lại.'
            ])->withInput();
        }

        // BƯỚC 2: tạo booking
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

        return redirect()->route('client.booking.show', $booking->id)
            ->with('success', 'Đặt vé thành công!');
    }

    public function showBooking(Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403, 'Không có quyền truy cập.');
        }

        $booking->load(['showtime.movie', 'showtime.room', 'seats.type']);

        return view('client.showbooking', compact('booking'));
    }

    public function history()
    {
        $bookings = Booking::with(['showtime.movie', 'showtime.room', 'seats.type'])
            ->where('user_id', Auth::id())
            ->orderByDesc('booking_time')
            ->get();

        return view('client..history', compact('bookings'));
    }
}
