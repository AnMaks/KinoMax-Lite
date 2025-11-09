<?php

namespace App\Kernal\Container;

use App\Kernal\Http\Request;
use App\Kernal\Router\Router;
use App\Kernal\View\View;

class Container
{

    public readonly Request $request;

    public readonly Router $router;

    public readonly View $view;

    public function __construct()
    {
     $this -> registerService();   
    }

    private function registerService(): void
    {
        $this ->request = Request::createFromGlobal();
        $this ->view = new View();
        $this ->router = new Router($this ->view, $this ->request);
    }
}