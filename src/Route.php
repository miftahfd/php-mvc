<?php

namespace Src;

class Route {
    private static array $routes = [];
    private static array $middlewares = [];

    private static function mapping(string $method, 
                                        string $path, 
                                        string $controller, 
                                        string $function): void {
        self::$routes[] = [
            'method' => $method,
            'path' => rtrim($path, '/'),
            'controller' => $controller,
            'function' => $function,
            'middlewares' => self::$middlewares
        ];
    }

    private static function getPattern($route_path) {
        $pattern_replace = "/{([\w\s]+)}/";
        $route_path = preg_replace($pattern_replace, "([0-9a-zA-z]*)", $route_path);
        $pattern = rtrim('#^' . $route_path . '$#', '/');

        return $pattern;
    }

    public static function middleware(array $middlewares = []): object {
        self::$middlewares = $middlewares;
        return new static();
    }

    public static function group(callable $callback): void {
        call_user_func($callback);
    }

    public static function get(string $path, string $controller, string $function): void {
        self::mapping('GET', $path, $controller, $function);
    }

    public static function post(string $path, string $controller, string $function): void {
        self::mapping('POST', $path, $controller, $function);
    }

    public static function put(string $path, string $controller, string $function): void {
        self::mapping('PUT', $path, $controller, $function);
    }

    public static function delete(string $path, string $controller, string $function): void {
        self::mapping('DELETE', $path, $controller, $function);
    }

    public static function execute(): void {
        $path = '/';
        if(isset($_SERVER['PATH_INFO'])) {
            $path = rtrim($_SERVER['PATH_INFO'], '/');
        }

        $method = $_SERVER['REQUEST_METHOD'];

        foreach(self::$routes as $route) {
            $pattern = self::getPattern($route['path']);
            
            if(preg_match($pattern, $path, $variables)) {
                if($route['method'] != $method) {
                    http_response_code(405);
                    echo 'Method not allowed';
                    return;
                }

                # middleware
                foreach($route['middlewares'] as $middleware) {
                    require_once __DIR__ . '/../config/app.php';
                    $middleware_config = getMiddlewareConfig();

                    $instance_middleware = new $middleware_config[$middleware];
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