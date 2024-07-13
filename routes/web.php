<?php

use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


// store
Route::post('/blogs',[BlogController::class,'store'])->name('blogs.store');

// index
Route::get('/blogs',[BlogController::class,'index'])->name('blogs.index');

// create
Route::get('/blogs/create',[BlogController::class,'create'])->name('blogs.create');