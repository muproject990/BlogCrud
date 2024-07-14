<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('register', [UserController::class, 'showRegistrationForm'])->name('register');

Route::post('register', [UserController::class, 'register'])->name('register.post');



Route::get('login', [UserController::class, 'showLoginForm'])->name('api.login');

Route::post('/login', [UserController::class, 'login'])->name('login.post');





Route::middleware('auth:api')->group(function () {

    Route::get('blogs', [BlogController::class, 'index'])->name('blogs.index');
});
