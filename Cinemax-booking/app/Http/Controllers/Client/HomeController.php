<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Movie;
use Illuminate\Http\Request;
use App\Models\Showtime;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $banners = Banner::where('status', 'active')->orderBy('id')->take(5)->get();

        $today = now()->toDateString(); // Lấy ngày hôm nay theo định dạng 'Y-m-d'

        // Lấy danh sách ngày có lịch chiếu, và lọc bỏ các ngày đã qua
        $dates = Showtime::select('show_date')
            ->distinct()
            ->whereDate('show_date', '>=', $today)
            ->orderBy('show_date')
            ->pluck('show_date');

        // Nếu không còn ngày nào (vì tất cả đã qua), thì không load phim
        if ($dates->isEmpty()) {
            return view('client.home', [
                'banners' => $banners,
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

        return view('client.home', compact('banners', 'movies', 'dates', 'selectedDate'));
    }
    public function search(Request $request)
    {
        $query = $request->input('query');

        // Tìm kiếm phim theo tên (title)
        $movies = Movie::where('title', 'LIKE', "%{$query}%")->get();

        return view('client.search_results', compact('movies', 'query'));
    }
}
