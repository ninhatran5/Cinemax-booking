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
        $today = Carbon::today();

        // Lấy danh sách ngày có lịch chiếu, chỉ lấy các ngày từ hôm nay trở đi
        $dates = Showtime::select('show_date')
            ->whereDate('show_date', '>=', $today)
            ->distinct()
            ->orderBy('show_date')
            ->pluck('show_date');

        // Lấy ngày được chọn từ request, nếu không có thì chọn ngày đầu tiên
        $selectedDate = $request->input('date');

        // Nếu không có ngày được chọn hoặc ngày đã qua hoặc không nằm trong danh sách ngày hợp lệ, chọn ngày đầu tiên
        if (!$selectedDate || !$dates->contains($selectedDate)) {
            $selectedDate = $dates->first();
        }

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
