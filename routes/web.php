<?php

use App\Http\Controllers\BiddingController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('listings.index');
});

Route::controller(ListingController::class)->group(function () {
    Route::get('/index', 'index')->name('listings.index');
    Route::get('/listing/{listing}', 'show')->name('listing.show');
    Route::get('/create', 'create')->middleware('auth')->name('listing.create');
    Route::post('/listing/store', 'store')->middleware('auth')->name('listing.store');
});

Route::controller(BiddingController::class)->group(function () {
    Route::post('/listing/{listing}/bid/store', 'store')->middleware('auth')->name('bid.store');
});

Route::controller(CommentController::class)->group(function () {
    Route::post('/listing/{listing}/comment/store', 'store')->middleware('auth')->name('comment.store');
});

Route::controller(UserController::class)->group(function () {
    Route::get('/login', 'show')->name('login');
    Route::post('/login/auth', 'authenticate')->name('user.auth');
    Route::post('logout', 'logout')->name('user.logout');
    Route::get('/register', 'register')->name('user.register');
    Route::post('/register/store', 'store')->name('user.store');
    Route::get('/dashboard', 'dashboard')->middleware('auth')->name('user.dashboard');
});
