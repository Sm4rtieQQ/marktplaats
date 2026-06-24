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
    Route::get('/create', 'create')->middleware(['auth', 'verified'])->name('listing.create');
    Route::get('listing/{listing}/edit', 'edit')->middleware(['auth', 'verified'])->name('listing.edit');
    Route::post('/listing/store', 'store')->middleware(['auth', 'verified'])->name('listing.store');
    Route::put('/listing/{listing}', 'update')->middleware(['auth', 'verified'])->name('listing.update');
    Route::delete('/listing/{listing}', 'destroy')->middleware(['auth', 'verified'])->name('listing.destroy');
});

Route::controller(BiddingController::class)->group(function () {
    Route::post('/listing/{listing}/bid/store', 'store')->middleware(['auth', 'verified'])->name('bid.store');
    Route::delete('/listing/bid/{bidding}', 'destroy')->middleware(['auth', 'verified'])->name('bid.destroy');
});

Route::controller(CommentController::class)->group(function () {
    Route::post('/listing/{listing}/comment', 'store')->middleware(['auth', 'verified'])->name('comment.store');
    Route::delete('/listing/{comment}/delete', 'destroy')->middleware(['auth', 'verified'])->name('comment.destroy');
});

Route::controller(UserController::class)->group(function () {
    Route::get('/dashboard', 'dashboard')->middleware('auth')->name('user.dashboard');

    Route::get('/login', 'show')->name('login');
    Route::post('/login/auth', 'authenticate')->name('user.auth');
    Route::post('logout', 'logout')->name('user.logout');

    Route::get('/register', 'register')->name('user.register');
    Route::post('/register/store', 'store')->name('user.store');
    Route::get('/email/verify', 'emailnotice')->middleware('auth')->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', 'emailfulfill')->middleware(['auth', 'signed'])->name('verification.verify');
    Route::post('/email/vefification-notification', 'emailsendlink')->middleware(['auth', 'throttle:6,1'])->name('verification.send');

    Route::get('/forgot-password', 'passwordrequest')->middleware('guest')->name('password.request');
    Route::post('/forgot-password', 'emailpassword')->middleware('guest')->name('password.email');
    Route::get('/reset-password/{token}', 'passwordreset')->middleware('guest')->name('password.reset');
});
