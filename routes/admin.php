<?php

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\DashboardController;

Route::group([
    'prefix' => 'api',
], function () {
    Route::get('posts', [BlogController::class, 'getPosts']);
});

Route::get('/{any?}', [DashboardController::class, 'index'])
    ->where('any', '.*')
    ->name('index');
