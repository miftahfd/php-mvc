<?php

namespace App;

class View {
    public static function render(string $view, $model) {
        require __DIR__ . "/../resources/views/{$view}.php";
    }
}