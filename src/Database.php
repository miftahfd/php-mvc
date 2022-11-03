<?php

namespace Src;

class Database {
    private static ?\PDO $pdo = null;

    public static function getConnection(string $env = 'test'): \PDO {
        if(self::$pdo == null) {
            require_once __DIR__ . '/../config/database.php';
            $config = getDatabaseConfig();
            self::$pdo = new \PDO(
                $config[$env]['url'],
                $config[$env]['username'],
                $config[$env]['password']
            );
        }

        return self::$pdo;
    }
}