
<?php

use App\Http\Controllers\Admin\AuthController;
use Illuminate\Support\Facades\Route;


// Instructor routes
// Route::prefix('instructor')->name('instructor.')->group(function () {
//     Route::match(['get', 'post'], 'login', [Instructor\AuthController::class, 'login'])->name('login')->withoutMiddleware('instructor');

//     Route::middleware('instructor')->group(function () {
//         Route::get('dashboard', [Instructor\DashboardController::class, 'index'])->name('dashboard');
//         Route::get('logout', [Instructor\AuthController::class, 'logout'])->name('logout');
//     });
// });
