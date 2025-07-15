<?php

use App\Http\Controllers\Admin\MovieController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\SeatController;

Route::get('/admin', function () {
    return view('admin.home');
});
Route::prefix('admin')->name('admin.')->group(function () {
    Route::prefix('rooms')->name('rooms.')->group(function () {
        Route::get('/', [RoomController::class, 'index'])->name('index');
        Route::get('/create', [RoomController::class, 'create'])->name('create');
        Route::post('/', [RoomController::class, 'store'])->name('store');
        Route::get('/edit/{room}', [RoomController::class, 'edit'])->name('edit');
        Route::put('/{room}', [RoomController::class, 'update'])->name('update');
        Route::delete('/{room}', [RoomController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('seats')->name('seats.')->group(function () {
        Route::get('/', [SeatController::class, 'index'])->name('index');
        Route::get('/create', [SeatController::class, 'create'])->name('create');
        Route::post('/', [SeatController::class, 'store'])->name('store');
        Route::get('/edit/{seat}', [SeatController::class, 'edit'])->name('edit');
        Route::put('/{seat}', [SeatController::class, 'update'])->name('update');
        Route::delete('/{seat}', [SeatController::class, 'destroy'])->name('destroy');
        Route::post('/delete-row', [SeatController::class, 'deleteRow'])->name('deleteRow');
    });
    Route::prefix('movies')->name('movies.')->group(function () {
        Route::get('/', [MovieController::class, 'index'])->name('index');
        Route::get('/create', [MovieController::class, 'create'])->name('create');
        Route::post('/', [MovieController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [MovieController::class, 'edit'])->name('edit');
        Route::put('/{id}', [MovieController::class, 'update'])->name('update');
        Route::delete('/{id}', [MovieController::class, 'destroy'])->name('destroy');
        Route::get('/trash', [MovieController::class, 'trash'])->name('trash');
        Route::put('/restore/{id}', [MovieController::class, 'restore'])->name('restore');
        Route::delete('/force/{id}', [MovieController::class, 'forceDelete'])->name('forceDelete');
    });
});
Route::get('/', function () {
    return view('client.home');
});
