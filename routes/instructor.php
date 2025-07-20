
<?php

use App\Http\Controllers\Instructor\AuthController;
use App\Http\Controllers\Instructor\DashboardController;
use App\Http\Controllers\Instructor\ProfileController;
use Illuminate\Support\Facades\Route;

// Instructor routes
Route::prefix('instructor')->name('instructor.')->group(function () {
    Route::match(['get', 'post'], 'login', [AuthController::class, 'login'])
        ->name('login')
        ->withoutMiddleware('auth_guard:instructor');

    Route::middleware('auth_guard:instructor')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::prefix('profile')->name('profile.')->group(function () {
            Route::get('/', [ProfileController::class, 'profile'])->name('index');
            Route::post('update', [ProfileController::class, 'updateProfile'])->name('update');
            Route::get('show/update/password', [ProfileController::class, 'showPasswordForm'])->name('show.update.password');
            Route::get('update/password', [ProfileController::class, 'updatePassword'])->name('update.password');
        });

        Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    });
});
