<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;

Route::get('/', function () {
    return view('home');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/post', [PostController::class, 'getPost'])->name('Post');
Route::get('/post/{slug}', [PostController::class, 'showPost'])->where('slug', '[\w\d\-\_]+')->name('RouteShowPost');

// route commente
Route::post('/comments/{post}', [CommentController::class, 'store'])->name('commentsstore');
Route::patch('/comments/{comment}', [CommentController::class, 'update'])->name('comment.update');
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comment.destroy');

Route::resource('/booking', BookingController::class);
Route::get('/contact', [ContactController::class, 'getContact']);
Route::get('/about', [AboutController::class, 'getAbout']);

Auth::routes();
