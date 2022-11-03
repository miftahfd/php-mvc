<?php

namespace Src;

use Jenssegers\Blade\Blade;

class View {
    public static function render(string $view, array $model) {
        $views = __DIR__ . '/../resources/views';
        $cache = __DIR__ . '/../resources/cache';
        $blade = new Blade($views, $cache);
        echo $blade->render($view, $model);
    }
}