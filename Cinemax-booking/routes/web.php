<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\SeatController;

Route::get('/admin', function () {
    return view('admin.home');
});
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('rooms', RoomController::class);
    Route::resource('seats', SeatController::class);
    Route::post('/seats/delete-row', [SeatController::class, 'deleteRow'])->name('seats.deleteRow');
});
Route::get('/', function () {
    return view('client.home');
});
