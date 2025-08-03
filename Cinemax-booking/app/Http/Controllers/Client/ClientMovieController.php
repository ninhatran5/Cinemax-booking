<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;
use App\Models\Showtime;
use Carbon\Carbon;

class ClientMovieController extends Controller
{
    public function index(Request $request)
    {
        $today = now()->toDateString(); // Lấy ngày hôm nay theo định dạng 'Y-m-d'

        // Lấy danh sách ngày có lịch chiếu, và lọc bỏ các ngày đã qua
        $dates = Showtime::select('show_date')
            ->distinct()
            ->whereDate('show_date', '>=', $today)
            ->orderBy('show_date')
            ->pluck('show_date');

        // Nếu không còn ngày nào (vì tất cả đã qua), thì không load phim
        if ($dates->isEmpty()) {
            return view('client.movie', [
                'movies' => collect(),
                'dates' => collect(),
                'selectedDate' => null,
            ]);
        }

        // Lấy ngày được chọn, mặc định là ngày đầu tiên
        $selectedDate = $request->input('date', $dates->first());

        // Lấy các phim có suất chiếu trong ngày được chọn
        $movies = Movie::whereHas('showtimes', function ($q) use ($selectedDate) {
            $q->where('show_date', $selectedDate);
        })
            ->with(['showtimes' => function ($q) use ($selectedDate) {
                $q->where('show_date', $selectedDate);
            }])
            ->get();

        return view('client.movie', compact('movies', 'dates', 'selectedDate'));
    }
}
