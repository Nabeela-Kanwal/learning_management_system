<?php

use App\Http\Controllers\Admin\AuthController;
use Illuminate\Support\Facades\Route;



Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AuthController::class, 'index'])->name('dashboard');
});
