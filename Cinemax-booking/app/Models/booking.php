<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Booking extends Model
{
    protected $fillable = [
        'order_code',
        'user_id',
        'showtime_id',
        'booking_time',
        'total_price',
        'payment_status'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($booking) {
            do {
                $code = 'CINEMAX' . strtoupper(Str::random(8));
            } while (self::where('order_code', $code)->exists());

            $booking->order_code = $code;
        });
    }

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
