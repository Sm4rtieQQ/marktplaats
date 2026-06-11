<?php

use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('listings.index');
});

Route::controller(ListingController::class)->group(function () {
    Route::get('/index', 'index')->name('listings.index');
    Route::get('/listing/{listing}', 'show')->name('listings.show');
    Route::get('/create', 'create')->name('listings.create');
    Route::post('/store', 'store')->name('listings.store');
});

Route::controller(UserController::class)->group(function () {
    Route::get('/login', 'show')->name('user.login');
    Route::post('/login/auth', 'authenticate')->name('user.auth');
    Route::get('/register', 'register')->name('user.register');
    Route::post('/register/store', 'store')->name('user.store');
    Route::get('/dashboard', 'dashboard')->name('user.dashboard');
});
