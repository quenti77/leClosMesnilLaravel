<?php


use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;

Route::resource('post', PostController::class);

Route::middleware('optimizeImages')->group(function () {
    // all images will be optimized automatically
    Route::post('post.store', 'PostController@store');
});

Route::resource('category', CategoryController::class);
Route::get('/category/{slug}', [CategoryController::class, 'show'])->name('admin.category.show');


