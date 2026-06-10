<?php

use App\Http\Controllers\ListingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('listings.index');
});

Route::controller(ListingController::class)->group(function () {
    Route::get('/index', 'index')->name('listings.index');
    Route::get('/listing/{listing}', 'show')->name('listings.show');
});
