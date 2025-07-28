<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;


class ClientLienHeController extends Controller
{
    public function index()
    {
        return view('client.lienhe');
    }
}
