<?php

use App\Models\Vehicle;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\SeatController;
use App\Http\Controllers\Admin\TripController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RouteController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\VehicleController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BookingSeatController;
use App\Http\Controllers\Admin\NotificationController;

// Route::get("/cities", function () {
//     return view("pages.admin.cities.index");
// });


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('users', UserController::class);
    Route::resource('cities', CityController::class);
    Route::resource('routes', RouteController::class);
    Route::resource('vehicles', VehicleController::class);
    Route::resource('seats', SeatController::class);
    Route::resource('trips', TripController::class);
    Route::resource('bookings', BookingController::class);
    Route::resource('booking_seats', BookingSeatController::class);

    Route::patch('bookings/{booking}/status', [BookingController::class, 'updateStatus'])
        ->name('bookings.updateStatus');

    Route::get('bookings/{booking}/ticket', [BookingController::class, 'ticket'])
        ->name('bookings.ticket');

    Route::post('bookings/{booking}/send-email', [BookingController::class, 'sendEmail'])
        ->name('bookings.sendEmail');
        
    Route::post('notifications/read-all', [NotificationController::class, 'markAllRead'])
        ->name('notifications.markAllRead');
});
