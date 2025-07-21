<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\User;
use App\Models\Showtime;
use App\Models\BookingSeat;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['user', 'showtime'])->orderBy('created_at', 'desc')->paginate(20);
        return view('admin.bookings.index', compact('bookings'));
    }

    public function show($id)
    {
        $booking = Booking::with(['user', 'showtime', 'bookingSeats.seat'])->findOrFail($id);
        return view('admin.bookings.show', compact('booking'));
    }

    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();
        return redirect()->route('admin.bookings.index')->with('success', 'Đã xóa đặt vé!');
    }
} 