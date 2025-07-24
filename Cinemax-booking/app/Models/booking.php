<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = ['user_id', 'showtime_id', 'booking_time', 'total_price', 'payment_status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function showtime()
    {
        return $this->belongsTo(Showtime::class);
    }

    public function bookingSeats()
    {
        return $this->hasMany(BookingSeat::class);
    }
    public function seats()
    {
        return $this->belongsToMany(Seat::class, 'booking_seats')
            ->withPivot('price')
            ->with('type'); 
    }
}
