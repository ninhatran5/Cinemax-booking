<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Showtime extends Model
{
    protected $fillable = ['movie_id', 'room_id', 'show_date', 'start_time', 'end_time'];

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    // Nếu sau này bạn có bảng bookings thì:
    // public function bookings() {
    //     return $this->hasMany(Booking::class);
    // }
}
