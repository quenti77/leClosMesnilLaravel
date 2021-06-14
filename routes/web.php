<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ContactController;

Route::get('/', function () {
    return view('home');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/post', [PostController::class, 'getPost'])->name('Post');

Route::resource('/booking', BookingController::class);

Route::get('/contact', [ContactController::class, 'getContact']);

Route::get('/about', [AboutController::class, 'getAbout']);

Auth::routes();

