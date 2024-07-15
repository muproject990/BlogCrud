<?php
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\BlogController;

Route::get('showRegisterPage', [ApiController::class, 'showRegisterPage'])->name('showRegisterPage');
Route::post('register', [ApiController::class, 'register'])->name('register');
Route::get('showLoginPage', [ApiController::class, 'showLoginPage'])->name('showLoginPage');
Route::post('loginpost', [ApiController::class, 'login'])->name('login.post');

// Protected Routes
Route::middleware('auth:api')->group(function () {


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

});