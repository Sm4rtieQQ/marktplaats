<?php

use App\Http\Controllers\BiddingController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('listings.index');
});

Route::controller(BiddingController::class)
    ->middleware(['auth', 'verified'])
    ->group(function () {
        Route::post('/listing/{listing}/bid/store', 'store')->name('bid.store');
        Route::delete('/listing/bid/{bidding}', 'destroy')->name('bid.destroy');
    });

Route::controller(ChatController::class)
    ->middleware(['auth', 'verified'])
    ->group(function () {
        Route::get('/chats', 'index')->name('chat.index');
        Route::get('/chat/{chat}', 'show')->name('chat.show');
        Route::post('/listing/{listing}/newChat', 'store')->name('chat.store');
    });

Route::controller(CommentController::class)
    ->middleware(['auth', 'verified'])
    ->group(function () {
        Route::post('/listing/{listing}/comment', 'store')->name('comment.store');
        Route::delete('/listing/{comment}/delete', 'destroy')->name('comment.destroy');
    });

Route::controller(ListingController::class)
    ->middleware(['auth', 'verified'])
    ->group(function () {
        Route::get('/listing/create', 'create')->name('listing.create');
        Route::get('/listing/{listing}/edit', 'edit')->name('listing.edit');
        Route::post('/listing/store', 'store')->name('listing.store');
        Route::put('/listing/{listing}', 'update')->name('listing.update');
        Route::get('/listing/{listing}/shop', 'shop')->name('listing.shop');
        Route::put('/listing/{listing}/promote', 'promote')->name('listing.promote');
        Route::delete('/listing/{listing}', 'destroy')->name('listing.destroy');
    });

Route::controller(ListingController::class)->group(function () {
    Route::get('/index', 'index')->name('listings.index');
    Route::get('/listing/{listing}', 'show')->name('listing.show');
});

Route::controller(MessageController::class)
    ->middleware(['auth', 'verified'])
    ->group(function () {
        Route::post('/chat/{chat}', 'store')->name('message.store');
    });

Route::controller(UserController::class)->group(function () {
    Route::get('/dashboard', 'dashboard')->middleware('auth')->name('user.dashboard');
    Route::put('/dashboard/{user}', 'toggleEmailNotifications')->middleware(['auth', 'verified'])->name('user.notifications');

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
    Route::post('/reset-password', 'passwordupdate')->middleware('guest')->name('password.update');
});
