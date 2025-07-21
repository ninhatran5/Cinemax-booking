<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;
use App\Models\Showtime;

class ClientMovieController extends Controller
{
    public function index(Request $request)
    {
    
        // Lấy danh sách ngày có lịch chiếu
        $dates = Showtime::select('show_date')->distinct()->orderBy('show_date')->pluck('show_date');
    
        // Lấy ngày được chọn, mặc định là ngày đầu tiên
        $selectedDate = $request->input('date', $dates->first());
    
        // Lấy các phim có suất chiếu trong ngày được chọn
        $movies = Movie::whereHas('showtimes', function($q) use ($selectedDate) {
            $q->where('show_date', $selectedDate);
        })
        ->with(['showtimes' => function($q) use ($selectedDate) {
            $q->where('show_date', $selectedDate);
        }])
        ->get();
    
        return view('client.movie', compact( 'movies', 'dates', 'selectedDate'));
    }
}
