<?php

namespace App\Kernal\Router;

use App\Kernal\Http\Redirect;
use App\Kernal\Http\Request;
use App\Kernal\Session\Session;
use App\Kernal\View\View;

class Router
{
    private array $routes = [
        'GET' => [],
        'POST' => [],
    ];

    public function __construct(
        private View $view,
        private Request $request,
        private Redirect $redirect,
        private Session $session,
    )
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

        if (is_array($route-> getAction())){
            [$controller, $action] = $route -> getAction();

            /**
             *  @var Controller $controller
             */

            $controller = new $controller();
            
            call_user_func([$controller, 'setView'], $this ->view);
            call_user_func([$controller, 'setRequest'], $this ->request);
            call_user_func([$controller, 'setRedirect'], $this ->redirect);
            call_user_func([$controller, 'setSession'], $this ->session);
            call_user_func([$controller, $action]);
        }
        else{
             call_user_func($route ->getAction());
        }
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