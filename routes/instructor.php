
<?php

use App\Http\Controllers\Instructor\AuthController;
use App\Http\Controllers\Instructor\DashboardController;
use App\Http\Controllers\Instructor\ProfileController;
use Illuminate\Support\Facades\Route;



// Instructor routes
Route::prefix('instructor')->name('instructor.')->group(function () {
    Route::match(['get', 'post'], 'login', [AuthController::class, 'login'])->name('login')->withoutMiddleware('auth_guard:instructor');

    Route::middleware('auth_guard:instructor')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('profile', [ProfileController::class, 'profile'])->name('profile');
        Route::post('profile/update', [ProfileController::class, 'update'])->name('profile.update');
        Route::post('profile/imgNew', [ProfileController::class, 'imgNew'])->name('profile.imgNew');
        Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    });
});
