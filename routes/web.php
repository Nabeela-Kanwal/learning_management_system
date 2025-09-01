<?php

use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\CategoryController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('about', [AboutController::class, 'index'])->name('about');

Route::prefix('categories')->name('category.')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('index');
});

// User routes
// Route::prefix('user')->name('user.')->group(function () {
//     Route::match(['get', 'post'], 'login', [User\AuthController::class, 'login'])->name('login')->withoutMiddleware('user');

//     Route::middleware('user')->group(function () {
//         Route::get('dashboard', [User\DashboardController::class, 'index'])->name('dashboard');
//         Route::get('logout', [User\AuthController::class, 'logout'])->name('logout');
//     });
// });
