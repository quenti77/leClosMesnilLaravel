<?php

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\DashboardController;

Route::group([
    'prefix' => 'api',
], function () {
    Route::get('categories', [BlogController::class, 'getCategories']);
    Route::post('categories', [BlogController::class, 'createCategory']);
    Route::patch('categories/{category}', [BlogController::class, 'updateCategory']);
    Route::delete('categories/{category}', [BlogController::class, 'deleteCategory']);

    Route::get('posts', [BlogController::class, 'getPosts']);
    Route::post('posts', [BlogController::class, 'createPost']);
    Route::patch('posts/{post}', [BlogController::class, 'updatePost']);
    Route::delete('posts/{post}', [BlogController::class, 'deletePost']);
});

Route::get('/{any?}', [DashboardController::class, 'index'])
    ->where('any', '.*')
    ->name('index');
