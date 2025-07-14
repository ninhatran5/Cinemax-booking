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
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
