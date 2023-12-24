<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', HomeController::class)->name('index');

Route::middleware('guest')->group(function (){

    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'authentificate']);

    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::controller(HotelController::class)->group(function () {
        Route::get('/hotels', 'index')->name('hotels.index');
        Route::get('/hotels/{hotel}', 'show')->name('hotels.show');
    });

    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'index')->name('profile');
        Route::put('/profile', 'passwordUpdate')->name('password.update');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'deleteProfile')->name('profile.destroy');
        Route::post('/verification-send', 'verification')->name('verification.send');
    });

    Route::controller(BookingController::class)->group(function () {
        Route::get('/bookings', 'index')->name('bookings.index');
        Route::get('/booking/{booking}', 'show')->name('bookings.show');
        Route::post('/booking/{id}', 'store')->name('bookings.store');
    });

    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});

