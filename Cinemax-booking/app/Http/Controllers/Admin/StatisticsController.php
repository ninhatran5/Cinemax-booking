<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Movie;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StatisticsController extends Controller
{
    public function index()
    {
        // 1. Tổng doanh thu
        $totalRevenue = Booking::where('payment_status', 'paid')->sum('total_price');

        // 2. Doanh thu theo tháng trong năm hiện tại
        $monthlyRevenue = Booking::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(total_price) as total')
        )
            ->whereYear('created_at', Carbon::now()->year)
            ->where('payment_status', 'paid')
            ->groupBy('month')
            ->pluck('total', 'month');

        // 3. Số lượng phim
        $movieCount = Movie::count();

        // 4. Số lượng người dùng
        $userCount = User::count();

        // 5. Top 5 phim doanh thu cao nhất
        $topMovies = Booking::join('showtimes', 'bookings.showtime_id', '=', 'showtimes.id')
            ->join('movies', 'showtimes.movie_id', '=', 'movies.id')
            ->select('movies.title', DB::raw('SUM(bookings.total_price) as revenue'))
            ->where('bookings.payment_status', 'paid')
            ->groupBy('movies.title')
            ->orderByDesc('revenue')
            ->limit(5)
            ->get();

        return view('admin.statistics.index', compact(
            'totalRevenue',
            'monthlyRevenue',
            'movieCount',
            'userCount',
            'topMovies'
        ));
    }
}
