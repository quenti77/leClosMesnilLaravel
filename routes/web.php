<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ContactController;

Route::get('/', function () {
    return view('home');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/post', [PostController::class, 'getPost']);

Route::get('/booking', [BookingController::class, 'getBooking']);

Route::get('/contact', [ContactController::class, 'getContact']);

Auth::routes();

