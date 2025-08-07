<?php

use App\Http\Controllers\Customer\HomeController;
use App\Http\Controllers\Admin\CityController;
use Illuminate\Support\Facades\Route;

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'showForm')->name('home');
    Route::get('/search-trip', 'search')->name('trips.search');
    Route::get('/seat', 'showSeat')->name('seat');
    Route::post('/select', 'storeSelection')->name('select');
    Route::get('/select', 'showTravellerForm')->name('traveller.form');
});




Route::get('/about', function () {
    return view('pages.customer.about');
})->name('about');
Route::get('/print', function () {
    return view('pages.customer.print');
})->name('print');
Route::get('/faq', function () {
    return view('pages.customer.faq');
})->name('faq');
Route::get('/pay', function () {
    return view('pages.customer.pay');
})->name('pay');


// Route::get('/select', function () {
//     return view('pages.customer.select');
// })->name('select');
Route::get('/payment', function () {
    return view('pages.customer.payment');
})->name('payment');
