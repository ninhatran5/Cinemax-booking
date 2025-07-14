<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
use App\Http\Controllers\Admin\RoomController;
Route::get('/admin', function () {return view('admin.home');});
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('rooms', RoomController::class);
});
Route::get('/', function () {return view('client.home');});