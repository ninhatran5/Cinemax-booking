<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    protected $fillable = [
        'room_id',
        'name',
        'row',
        'seat_type',
        'position_x',
        'position_y',
        'price',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
    public function bookingSeats()
    {
        return $this->hasMany(Booking_seats::class);
    }
}
