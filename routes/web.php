<?php

use App\Controllers\Auth\LoginController;
use App\Controllers\PostController;
use App\Middlewares\AuthMiddleware;
use Src\Route;

Route::get('/login', LoginController::class, 'index');
Route::get('/posts', PostController::class, 'index', [AuthMiddleware::class]);
Route::get("/post/{id}", PostController::class, 'detail', [AuthMiddleware::class]);

Route::execute();