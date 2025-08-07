<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class HomeAdminController extends Controller
{
    public function home()
    {
        return view('admin.home.index');
    }
}
