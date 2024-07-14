<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('auth.register');
// });



// // index
// Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');

// // store
// Route::post('/blogs', [BlogController::class, 'store'])->name('blogs.store');

// // create
// Route::get('/blogs/create', [BlogController::class, 'create'])->name('blogs.create');


// // edit
// Route::get('/blogs/{blog}/edit', [BlogController::class, 'edit'])->name('blogs.edit');

// // update
// Route::put('/blogs/{blog}/edit', [BlogController::class, 'update'])->name('blogs.update');

// // delete

// Route::delete('/blogs/{blog}', [BlogController::class, 'destroy'])->name('blogs.destroy');





/// Show the registration form
Route::get('/register', [UserController::class, 'showRegistrationForm'])->name('register');

// Handle registration form submission
Route::post('/register/post', [UserController::class, 'register'])->name('register.post');



// Show the signup form
Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');

// login
Route::post('/login/post', [UserController::class, 'login'])->name('login.post');



// Logout
Route::post('/logout', [UserController::class, 'logout'])->name('logout');




Route::middleware('auth')->group(function () {

    // index
    Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');

    // store
    Route::post('/blogs', [BlogController::class, 'store'])->name('blogs.store');

    // create
    Route::get('/blogs/create', [BlogController::class, 'create'])->name('blogs.create');


    // edit
    Route::get('/blogs/{blog}/edit', [BlogController::class, 'edit'])->name('blogs.edit');

    // update
    Route::put('/blogs/{blog}/edit', [BlogController::class, 'update'])->name('blogs.update');

    // delete

    Route::delete('/blogs/{blog}', [BlogController::class, 'destroy'])->name('blogs.destroy');


    Route::get('/blogs/{blog}/open', [BlogController::class, 'open'])->name('blogs.open');

    // comment
    Route::get('/blogs/comment
    ', [BlogController::class, 'blogComment'])->name('blogs.comment');

    Route::post('/blogs/{blog}/comment', [BlogController::class, 'storeComment'])->name('blogs.comment');

    // Route::get('/blogs/{blog}/comments', [BlogController::class, 'showComments'])->name('blogs.comments');
});
