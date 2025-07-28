<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;


class ClientGiaVeController extends Controller
{
    public function index()
    {
        return view('client.giave');
    }
}
