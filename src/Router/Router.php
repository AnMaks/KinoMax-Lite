<?php

namespace App\Router;

class Router
{
    private array $routes = [
        'GET' => [],
        'POST' => [],
    ];

    public function __construct()
    {
        $this->initRouters();
    }

    public function dispatch(string $uri, string $method): void
    {
        $route = $this -> findRoute($uri, $method);

        if (! $route){
            $this -> notFound();
            return;
        }

        $route ->getAction()();
    }

    private function notFound(): void {
        echo '404 | Not Found';
    }

    private function findRoute(string $uri, string $method) : Route|false
    {
         return $this->routes[$method][$uri] ?? false;
    }

    private function initRouters()
    {
        $routes = $this->getRoutes();

        foreach ($routes as $route) {
            $this->routes[$route->getMethod()][$route->getUri()] = $route;
        }

        
    }
    /**
     * @return Route[]
     */

    private function getRoutes(): array
    {
        return require_once APP_PATH . '/config/routes.php';
    }
}