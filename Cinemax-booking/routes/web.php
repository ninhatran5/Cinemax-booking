<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BannerController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\IsAdmin;
use App\Http\Controllers\Admin\MovieController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\SeatController;
use App\Http\Controllers\Admin\ShowtimeController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\ClientAuthController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Client\ClientBookingController;
use App\Http\Controllers\Client\ClientMovieController;

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->group(function () {
    // Trang login
    Route::get('/', function () {
        return view('admin.login');
    });

    // Xử lý login
    Route::match(['get', 'post'], '/login', [AuthController::class, 'login'])->name('login');

    // Nhóm route cần kiểm tra IsAdmin middleware
    Route::middleware([IsAdmin::class])->group(function () {
        Route::get('/home', function () {
            return view('admin.home');
        })->name('home');

        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

        // QUẢN LÝ PHIM
        Route::prefix('movies')->name('movies.')->group(function () {
            Route::get('/', [MovieController::class, 'index'])->name('index');
            Route::get('/create', [MovieController::class, 'create'])->name('create');
            Route::post('/', [MovieController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [MovieController::class, 'edit'])->name('edit');
            Route::put('/{id}', [MovieController::class, 'update'])->name('update');
            Route::delete('/{id}', [MovieController::class, 'destroy'])->name('destroy');
            Route::get('/trash', [MovieController::class, 'trash'])->name('trash');
            Route::put('/restore/{id}', [MovieController::class, 'restore'])->name('restore');
            Route::delete('/force/{id}', [MovieController::class, 'forceDelete'])->name('forceDelete');
        });

        // QUẢN LÝ PHÒNG CHIẾU
        Route::prefix('rooms')->name('rooms.')->group(function () {
            Route::get('/', [RoomController::class, 'index'])->name('index');
            Route::get('/create', [RoomController::class, 'create'])->name('create');
            Route::post('/', [RoomController::class, 'store'])->name('store');
            Route::get('/edit/{room}', [RoomController::class, 'edit'])->name('edit');
            Route::put('/{room}', [RoomController::class, 'update'])->name('update');
            Route::delete('/{room}', [RoomController::class, 'destroy'])->name('destroy');
        });

        // QUẢN LÝ GHẾ
        Route::prefix('seats')->name('seats.')->group(function () {
            Route::get('/', [SeatController::class, 'index'])->name('index');
            Route::get('/create', [SeatController::class, 'create'])->name('create');
            Route::post('/', [SeatController::class, 'store'])->name('store');
            Route::get('/edit/{seat}', [SeatController::class, 'edit'])->name('edit');
            Route::put('/{seat}', [SeatController::class, 'update'])->name('update');
            Route::delete('/{seat}', [SeatController::class, 'destroy'])->name('destroy');
            Route::post('/delete-row', [SeatController::class, 'deleteRow'])->name('deleteRow');
        });

        // QUẢN LÝ LỊCH CHIẾU
        Route::prefix('showtimes')->name('showtimes.')->group(function () {
            Route::get('/', [ShowtimeController::class, 'index'])->name('index');
            Route::get('/create', [ShowtimeController::class, 'create'])->name('create');
            Route::post('/', [ShowtimeController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [ShowtimeController::class, 'edit'])->name('edit');
            Route::put('/{id}', [ShowtimeController::class, 'update'])->name('update');
            Route::delete('/{id}', [ShowtimeController::class, 'destroy'])->name('destroy');
        });
        // QUẢN LÝ BANNERS
        Route::prefix('banners')->name('banners.')->group(function () {
            Route::get('/', [BannerController::class, 'index'])->name('index');
            Route::get('/edit/{banner}', [BannerController::class, 'edit'])->name('edit');
            Route::put('/{banner}', [BannerController::class, 'update'])->name('update');
        });

        // QUẢN LÝ ĐẶT VÉ
        Route::resource('bookings', BookingController::class)->only(['index', 'show', 'destroy']);
    });
});


/*
|--------------------------------------------------------------------------
| CLIENT ROUTES
|--------------------------------------------------------------------------
*/

// Trang chủ client
Route::get('/', [HomeController::class, 'index'])->name('client.home');
Route::get('/movie', [ClientMovieController::class, 'index'])->name('client.movie');


// Đăng nhập
Route::get('/login', [ClientAuthController::class, 'showLoginForm'])->name('client.login');
Route::post('/login', [ClientAuthController::class, 'login']);

// Đăng ký
Route::post('/register', [ClientAuthController::class, 'register'])->name('client.register');

// Đăng xuất
Route::post('/logout', [ClientAuthController::class, 'logout'])->name('client.logout');
Route::get('/chon-ghe-modal/{showtime}', [ClientBookingController::class, 'loadSeatModal'])->name('client.booking.modal');
Route::post('/dat-ve/{showtime}', [ClientBookingController::class, 'storeBooking'])->name('client.booking.store');


