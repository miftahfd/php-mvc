<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Src\Database;

class DatabaseTest extends TestCase {
    public function testGetConnection(): void {
        $connection = Database::getConnection();
        self::assertNotNull($connection);
    }

    public function testGetConnectionSingleton(): void {
        $connection1 = Database::getConnection();
        $connection2 = Database::getConnection();
        self::assertSame($connection1, $connection2);
    }
}