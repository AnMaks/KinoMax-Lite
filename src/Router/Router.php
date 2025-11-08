<?php

namespace App\Router;

class Router
{
    public function dispatch(string $uri): void
    {
        $routers = $this->getRoutes();

        $routers[$uri]();
    }

    private function getRoutes(): array
    {
        return require_once APP_PATH . '/config/routes.php';

    }
}