<?php

namespace App\Controllers\Auth;

use App\View;

class LoginController {
    public function index(): void {
        $model = ['title' => 'Login'];

        View::render('auth/login', $model);
    }
}