<?php

use App\Controllers\Auth\LoginController;
use App\Controllers\PostController;
use App\Middlewares\AuthMiddleware;
use App\Route;

$pattern_alphanumeric = "([0-9a-zA-z]*)";
$pattern_numeric = "([0-9*)";

Route::get('/login', LoginController::class, 'index');
Route::get('/posts', PostController::class, 'index', [AuthMiddleware::class]);
Route::get("/post/$pattern_alphanumeric", PostController::class, 'detail', [AuthMiddleware::class]);

Route::execute();