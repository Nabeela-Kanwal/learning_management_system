<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\InfoController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\YajraController;
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
            Route::get('create', [CategoryController::class, 'create'])->name('create');
            Route::post('store', [CategoryController::class, 'store'])->name('store');
            Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('edit');
            Route::put('update/{id}', [CategoryController::class, 'update'])->name('update');
            Route::delete('destroy', [CategoryController::class, 'destroy'])->name('destroy');
            Route::get('yajra', [YajraController::class, 'getCategoriesData'])->name('yajra');
        });

        Route::prefix('sub-categories')->name('sub-category.')->group(function () {
            Route::get('/', [SubCategoryController::class, 'index'])->name('index');
            Route::get('create', [SubCategoryController::class, 'create'])->name('create');
            Route::post('store', [SubCategoryController::class, 'store'])->name('store');
            Route::get('edit/{id}', [SubCategoryController::class, 'edit'])->name('edit');
            Route::put('update/{id}', [SubCategoryController::class, 'update'])->name('update');
            Route::post('destroy/{id}', [SubCategoryController::class, 'destroy'])->name('destroy');
            Route::get('yajra', [YajraController::class, 'getSubCategoriesData'])->name('yajra');
        });

        Route::prefix('banners')->name('banner.')->group(function () {
            Route::get('/', [BannerController::class, 'index'])->name('index');
            Route::get('create', [BannerController::class, 'create'])->name('create');
            Route::post('store', [BannerController::class, 'store'])->name('store');
            Route::get('edit/{id}', [BannerController::class, 'edit'])->name('edit');
            Route::put('update/{id}', [BannerController::class, 'update'])->name('update');
            Route::delete('destroy', [BannerController::class, 'destroy'])->name('destroy');
            Route::get('yajra', [YajraController::class, 'getBannerData'])->name('yajra');
        });


        Route::prefix('infoBox')->name('info.')->group(function () {
            Route::get('/', [InfoController::class, 'index'])->name('index');
            // Route::put('update/{id}', [InfoController::class, 'update'])->name('update');

        });
    });
