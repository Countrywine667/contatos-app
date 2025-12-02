<?php

namespace Src\Router;

class Router
{
    private array $routes = [];

    public function add(string $method, string $pattern, $handler)
    {
        // transform /edit/{id} => regex and capture keys
        $keys = [];
        $regex = preg_replace_callback('/\{([^}]+)\}/', function ($m) use (&$keys) {
            $keys[] = $m[1];
            return '([^\/]+)';
        }, $pattern);

        $this->routes[] = [
            'method' => strtoupper($method),
            'pattern' => '#^' . $regex . '$#',
            'handler' => $handler,
            'keys' => $keys,
            'raw' => $pattern
        ];
    }

    public function dispatch()
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];

        foreach ($this->routes as $route) {
            if ($route['method'] !== $method) continue;

            if (preg_match($route['pattern'], $uri, $matches)) {
                array_shift($matches); // remove full match
                $params = [];
                foreach ($route['keys'] as $i => $key) {
                    $params[$key] = $matches[$i] ?? null;
                }

                // call handler: if array [controller, 'method']
                $handler = $route['handler'];

                if (is_callable($handler)) {
                    // If handler expects params, pass them
                    return call_user_func_array($handler, $params);
                } elseif (is_array($handler) && is_object($handler[0])) {
                    $methodName = $handler[1];
                    return call_user_func_array([$handler[0], $methodName], $params);
                }
            }
        }

        // 404
        http_response_code(404);
        echo "404 - Not Found";
    }
}
