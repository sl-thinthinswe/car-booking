<?php

use App\Http\Controllers\Customer\HomeController;
use Illuminate\Support\Facades\Route;

Route::get("/", function () {
    return view("pages.customer.home");
})->name('home');
Route::get('/about', function () {
    return view('pages.customer.about');
})->name('about');
Route::get('/print', function () {
    return view('pages.customer.print');
})->name('print');
Route::get('/faq', function () {
    return view('pages.customer.faq');
})->name('faq');
// Show search form
Route::get('/search', function () {
    return view('pages.customer.search');
})->name('search');
Route::get('/seat', function () {
    return view('pages.customer.seat');
})->name('seat');
Route::get('/select', function () {
    return view('pages.customer.select');
})->name('select');
Route::get('/payment', function () {
    return view('pages.customer.payment');
})->name('payment');
