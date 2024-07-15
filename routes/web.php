<?php

use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\BlogController;

// Open Routes
Route::get('showRegisterPage', [ApiController::class, 'showRegisterPage'])->name('showRegisterPage');
Route::post('register', [ApiController::class, 'register'])->name('register');
Route::get('showLoginPage', [ApiController::class, 'showLoginPage'])->name('showLoginPage');
Route::post('login', [ApiController::class, 'login'])->name('login');

// Protected Routes
Route::middleware('auth:api')->group(function () {
    Route::get('blogs', [BlogController::class, 'index'])->name('blogs.index');
    // Route::get('blogs', [BlogController::class, 'index'])->name('blogs.index');
});
