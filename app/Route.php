<?php

namespace App;

class Route {
    private static array $routes = [];

    private static function mapping(string $method, 
                                        string $path, 
                                        string $controller, 
                                        string $function,
                                        array $middlewares = []): void {
        self::$routes[] = [
            'method' => $method,
            'path' => rtrim($path, '/'),
            'controller' => $controller,
            'function' => $function,
            'middlewares' => $middlewares
        ];
    }

    public static function get(string $path, string $controller, string $function, array $middlewares = []): void {
        self::mapping('GET', $path, $controller, $function, $middlewares);
    }

    public static function post(string $path, string $controller, string $function, array $middlewares = []): void {
        self::mapping('POST', $path, $controller, $function, $middlewares);
    }

    public static function put(string $path, string $controller, string $function, array $middlewares = []): void {
        self::mapping('PUT', $path, $controller, $function, $middlewares);
    }

    public static function delete(string $path, string $controller, string $function, array $middlewares = []): void {
        self::mapping('DELETE', $path, $controller, $function, $middlewares);
    }

    public static function execute(): void {
        $path = '/';
        if(isset($_SERVER['PATH_INFO'])) {
            $path = rtrim($_SERVER['PATH_INFO'], '/');
        }

        $method = $_SERVER['REQUEST_METHOD'];

        foreach(self::$routes as $route) {
            $pattern = rtrim('#^' . $route['path'] . '$#', '/');
            if(preg_match($pattern, $path, $variables)) {
                if($route['method'] != $method) {
                    http_response_code(405);
                    echo 'Method not allowed';
                    return;
                }

                # middleware
                foreach($route['middlewares'] as $middleware) {
                    $instance_middleware = new $middleware;
                    $instance_middleware->before();
                }

                $controller = new $route['controller'];
                $function = $route['function'];
                array_shift($variables);
                call_user_func_array([$controller, $function], $variables);
                
                return;
            }
        }

        http_response_code(404);
        echo "Controller not found";
    }
}