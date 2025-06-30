<?php

use Illuminate\Support\Facades\Route;

Route::get("/cities", function () {
    return view("pages.admin.city.index");
});