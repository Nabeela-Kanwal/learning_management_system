<?php

use App\Http\Controllers\Admin\AuthController;
use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', [AuthController::class, 'index'])->name('dashborad');
