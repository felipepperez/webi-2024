<?php

class Router
{
    private $routes = [];

    public function add($method, $path, $callback)
    {
        $path = preg_replace('/\{(\w+)\}/', '(\d+)', $path);
        $this->routes[] = ['method' => $method, 'path' => "#^" . $path . "$#", 'callback' => $callback];
    }

    public function dispatch($requestedPath)
    {
        $requestedMethod = $_SERVER["REQUEST_METHOD"];

        foreach ($this->routes as $route) {
            if ($route['method'] === $requestedMethod && preg_match($route['path'], $requestedPath, $matches)) {
                array_shift($matches);
                return call_user_func($route['callback'], $matches[0]);
            }
        }
        echo "404 - Página não encontrada";
    }
}