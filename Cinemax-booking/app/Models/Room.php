<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'capacity'];

    public function showtimes()
    {
        return $this->hasMany(Showtime::class);
    }

    public function seats()
    {
        return $this->hasMany(Seat::class);
    }
}
