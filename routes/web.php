<?php


use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;

Route::get('/', [HomeController::class, 'index'])->name('index');

Route::get('/post', [PostController::class, 'index'])->name('post.index');
Route::get('/post/{slug}', [PostController::class, 'show'])->where('slug', '[\w\d\-\_]+')->name('RouteShowPost');

Route::post('/comments/{post}', [CommentController::class, 'store'])->name('comment.store');
Route::patch('/comments/{comment}', [CommentController::class, 'update'])->name('comment.update');
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comment.destroy');

Route::get('/booking', [BookingController::class, 'index'])->name('booking');
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');

Route::get('/category/{slug}', [CategoryController::class, 'show'])->name('category.show');

Auth::routes();
