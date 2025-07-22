<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    protected $fillable = [
        'room_id',
        'name',
        'row',
        'seat_type_id', // sửa đúng theo cột trong DB
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
        return $this->hasMany(BookingSeat::class);
    }

    public function type()
    {
        return $this->belongsTo(SeatType::class, 'seat_type_id');
    }

    // Nếu trong view bạn gọi $seat->seatType thì cần thêm accessor:
    public function getSeatTypeAttribute()
    {
        return $this->type;
    }
}
