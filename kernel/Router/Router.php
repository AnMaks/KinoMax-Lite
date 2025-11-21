<?php

namespace App\Kernal\Router;

use App\Kernal\Auth\AuthInterface;
use App\Kernal\View\ViewInterface;
use App\Kernal\Http\RequestInterface;
use App\Kernal\Http\RedirectInterface;
use App\Kernal\Session\SessionInterface;
use App\Kernal\DataBase\DataBaseInteface;
use App\Kernal\Middleware\AbstractMiddlewere;

class Router implements RouterInterface
{
    private array $routes = [
        'GET' => [],
        'POST' => [],
    ];

    public function __construct(
        private ViewInterface $view,
        private RequestInterface $request,
        private RedirectInterface $redirect,
        private SessionInterface $session,
        private DataBaseInteface $database,
        private AuthInterface $auth,
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

        if( $route -> hasMiddleware()){
            foreach($route -> getMiddleware() as $middleware){
                /** @var AbstractMiddlewere $middleware */
                $middleware = new $middleware($this ->request, $this ->auth, $this ->redirect);

                $middleware ->handle();
            }
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
            call_user_func([$controller, 'setDatabase'], $this ->database);
            call_user_func([$controller, 'setAuth'], $this ->auth);
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