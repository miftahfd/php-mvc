<?php

function getMiddlewareConfig(): array {
    return [
        'authenticate' => App\Middlewares\AuthMiddleware::class
    ];
}