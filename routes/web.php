<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});



// User routes
// Route::prefix('user')->name('user.')->group(function () {
//     Route::match(['get', 'post'], 'login', [User\AuthController::class, 'login'])->name('login')->withoutMiddleware('user');

//     Route::middleware('user')->group(function () {
//         Route::get('dashboard', [User\DashboardController::class, 'index'])->name('dashboard');
//         Route::get('logout', [User\AuthController::class, 'logout'])->name('logout');
//     });
// });
