<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Movie;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $banners = Banner::where('status', 'active')
            ->orderBy('id')
            ->take(5)
            ->get();

        return view('client.home', compact('banners'));
    }
}
