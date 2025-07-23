<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SubCategoryController;
use Illuminate\Support\Facades\Route;



Route::middleware(['web', 'auth_guard:admin'])
    ->prefix('admin')
    ->as('admin.')
    ->group(function () {
        Route::get('/', fn() => redirect()->route('admin.dashboard'));
        Route::match(['get', 'post'], 'login', [AuthController::class, 'login'])
            ->name('login')
            ->withoutMiddleware('auth_guard:admin');
        Route::get('logout', [AuthController::class, 'logout'])->name('logout');
        Route::middleware('auth_guard:admin')->group(function () {
            Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
            Route::prefix('profile')->name('profile.')->group(function () {
                Route::get('/', [ProfileController::class, 'profile'])->name('index');
                Route::post('update', [ProfileController::class, 'updateProfile'])->name('update');
                Route::get('show/update/password', [ProfileController::class, 'showPasswordForm'])->name('show.update.password');
                Route::post('update/password', [ProfileController::class, 'updatePassword'])->name('update.password');
            });

            Route::get('logout', [AuthController::class, 'logout'])->name('logout');
        });

        Route::prefix('categories')->name('category.')->group(function () {
            Route::get('/', [CategoryController::class, 'index'])->name('index');
            Route::post('store', [CategoryController::class, 'store'])->name('store');
            Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('edit');
            Route::post('update/{id}', [CategoryController::class, 'update'])->name('update');
            Route::post('destroy/{id}', [CategoryController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('sub-categories')->name('sub-category.')->group(function () {
            Route::get('/', [SubCategoryController::class, 'index'])->name('index');
            Route::post('store', [SubCategoryController::class, 'store'])->name('store');
            Route::get('edit/{id}', [SubCategoryController::class, 'edit'])->name('edit');
            Route::post('update/{id}', [SubCategoryController::class, 'update'])->name('update');
            Route::post('destroy/{id}', [SubCategoryController::class, 'destroy'])->name('destroy');
        });
    });
