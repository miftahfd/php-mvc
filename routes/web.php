<?php

use App\Controllers\Auth\LoginController;
use App\Controllers\PostController;
use Src\Route;

Route::get('/login', LoginController::class, 'index');

Route::middleware(['authenticate'])->group(function() {
    Route::get('/posts', PostController::class, 'index');
    Route::get("/post/{id}", PostController::class, 'detail');
});

Route::execute();