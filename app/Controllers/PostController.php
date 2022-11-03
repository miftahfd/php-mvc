<?php

namespace App\Controllers;

use Src\View;

class PostController {
    public function index(): void {
        $model = ['title' => 'Postingan'];

        View::render('post/index', $model);
    }

    public function detail(string $post_id): void {
        $model = ['title' => "Postingan $post_id"];

        View::render('post/index', $model);
    }
}