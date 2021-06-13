<?php

use App\Http\Controllers\Admin\CommentPostController;
use App\Http\Controllers\Admin\PostController;
use Illuminate\Support\Facades\Route;

Route::resource('post', PostController::class);
Route::resource('commentPost', CommentPostController::class);
