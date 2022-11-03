<?php

namespace Src;

class View {
    public static function render(string $view, $model) {
        $model = extract($model);
        require __DIR__ . "/../resources/views/{$view}.php";
    }
}