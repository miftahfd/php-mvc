<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

class RegexTest extends TestCase {
    public function testRegex() {
        $path = "/products/123456/categories/abcde";
        $pattern = "#^/products/([0-9a-zA-Z]*)/categories/([0-9a-zA-Z]*)$#";
        $result = preg_match($pattern, $path, $variables);

        self::assertTrue($result);
        var_dump($variables);
    }
}