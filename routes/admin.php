<?php


use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;

Route::resource('post', PostController::class);

Route::resource('category', CategoryController::class);
