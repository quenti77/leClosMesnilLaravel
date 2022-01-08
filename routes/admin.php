<?php

use App\Http\Controllers\Admin\DashboardController;

Route::get('/{any?}', [DashboardController::class, 'index'])
    ->where('any', '.*')
    ->name('index');
