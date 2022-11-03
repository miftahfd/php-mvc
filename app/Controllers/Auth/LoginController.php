<?php

namespace App\Controllers\Auth;

use Src\View;

class LoginController {
    public function index(): void {
        $model = ['title' => 'Login'];

        View::render('auth/login', $model);
    }
}