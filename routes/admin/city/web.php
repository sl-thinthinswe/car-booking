<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\TripController;
use App\Http\Controllers\Admin\RouteController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\VehicleController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SeatController;
use App\Http\Controllers\Admin\UserController;
use App\Models\Vehicle;

// Route::get("/cities", function () {
//     return view("pages.admin.cities.index");
// });


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


Route::prefix('admin')->name('admin.')->group(function () {
Route::resource('users', UserController::class);
Route::resource('cities', CityController::class);
Route::resource('routes', RouteController::class);
Route::resource('vehicles', VehicleController::class);
Route::resource('seats', SeatController::class);
Route::resource('trips', TripController::class);
Route::resource('bookings', BookingController::class);
});
