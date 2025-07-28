<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;


class ClientGioiThieuController extends Controller
{
    public function index()
    {
        return view('client.gioithieu');
    }
}
