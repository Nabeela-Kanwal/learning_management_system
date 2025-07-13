
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Instructor\DashboardController;
use App\Http\Controllers\Instructor\AuthController;


// Instructor routes
Route::prefix('instructor')->name('instructor.')->group(function () {
    Route::match(['get', 'post'], 'login', [AuthController::class, 'login'])->name('login')->withoutMiddleware('auth_guard:instructor');

    Route::middleware('auth_guard:instructor')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    });
});
