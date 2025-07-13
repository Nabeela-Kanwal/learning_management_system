<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AuthController;

Route::middleware(['web', 'auth_guard:admin'])
    ->prefix('admin')
    ->as('admin.')
    ->group(function () {
        Route::get('/', fn() => redirect()->route('admin.dashboard'));

        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::match(['get', 'post'], 'login', [AuthController::class, 'login'])
            ->name('login')
            ->withoutMiddleware('auth_guard:admin');
            Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    });
