<?php

function getDatabaseConfig(): array {
    return [
        'test' => [
            'url' => 'mysql:host=localhost:3306;dbname=php_mvc_test',
            'username' => 'root',
            'password' => ''
        ],
        'non_test' => [
            'url' => 'mysql:host=localhost:3306;dbname=php_mvc',
            'username' => 'root',
            'password' => ''
        ]
    ];
}