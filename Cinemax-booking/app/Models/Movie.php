<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Movie extends Model
{
    use SoftDeletes;
    protected $fillable = ['title', 'description', 'image', 'duration', 'status'];

    public function showtimes()
    {
        return $this->hasMany(Showtime::class);
    }
}
