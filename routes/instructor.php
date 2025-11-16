<?php

use App\Http\Controllers\Instructor\AuthController;
use App\Http\Controllers\Instructor\CourseController;
use App\Http\Controllers\Instructor\DashboardController;
use App\Http\Controllers\Instructor\ProfileController;
use App\Http\Controllers\Instructor\YajraController;
use Illuminate\Support\Facades\Route;

Route::prefix('instructor')->name('instructor.')->group(function () {
    Route::match(['get', 'post'], 'login', [AuthController::class, 'login'])
        ->name('login')
        ->withoutMiddleware('auth_guard:instructor');



    Route::middleware('auth_guard:instructor')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');


        Route::get('whoami', function () {
    return [
        'guard' => 'instructor',
        'auth_instructor_id' => auth('instructor')->id(),
        'auth_default_id' => auth()->id(),
        'user' => auth('instructor')->user(),
    ];
});


        Route::prefix('profile')->name('profile.')->group(function () {
            Route::get('/', [ProfileController::class, 'profile'])->name('index');
            Route::post('update', [ProfileController::class, 'updateProfile'])->name('update');
            Route::get('show/update/password', [ProfileController::class, 'showPasswordForm'])->name('show.update.password');
            Route::post('update/password', [ProfileController::class, 'updatePassword'])->name('update.password');
        });

        Route::prefix('courses')->name('course.')->group(function () {
            Route::get('/', [CourseController::class, 'index'])->name('index');
            Route::get('create', [CourseController::class, 'create'])->name('create');
            Route::post('store', [CourseController::class, 'store'])->name('store');
            Route::get('edit/{id}', [CourseController::class, 'edit'])->name('edit');
            Route::put('update/{id}', [CourseController::class, 'update'])->name('update');
           Route::delete('destroy/{id}', [CourseController::class, 'destroy'])->name('destroy');
            Route::get('yajra', [YajraController::class, 'getcoursesData'])->name('yajra');
        });

        Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    });
});
