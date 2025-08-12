<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Customer\HomeController;
use App\Http\Controllers\Customer\BookingController;

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'showForm')->name('home');
    Route::get('/search-trip', 'search')->name('trips.search');
    Route::get('/seat', 'showSeat')->name('seat');
    Route::post('/select', 'storeSelection')->name('select');
    Route::get('/select', 'showTravellerForm')->name('traveller.form');
});
Route::prefix('booking')->group(function () {
    Route::post('/pending', [BookingController::class, 'storePending'])->name('booking.storePending');
    Route::get('/{booking}/payment', [BookingController::class, 'paymentPage'])->name('booking.payment');
    Route::post('/{booking}/confirm', [BookingController::class, 'confirmPayment'])->name('booking.confirm');
    Route::post('/{booking}/cancel', [BookingController::class, 'cancel'])->name('booking.cancel');  
    Route::get('/{booking}/success', [BookingController::class, 'successPage'])->name('booking.success');
    Route::get('/{booking}/receipt', [BookingController::class, 'receiptPage'])->name('booking.receipt');
    Route::get('/print', [BookingController::class, 'showRetrieveForm'])->name('print');
Route::get('/booking/retrieve', [BookingController::class, 'retrieve'])->name('booking.retrieve');

});




Route::get('/about', function () {
    return view('pages.customer.about');
})->name('about');
// Route::get('/print', function () {
// //     return view('pages.customer.print');
// // })->name('print');
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
