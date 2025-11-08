<?php

namespace App\Kernal;

use App\Kernal\Container\Container;
use App\Kernal\Http\Request;
use App\Kernal\Router\Router;

class App
{
    private Container $container;

    public function __construct()
    {
        $this->container = new Container();
    }

    public function run(): void
    {
        $this->container->request;
        //dd($_SERVER);

        $this->container->router->dispatch(
                $this->container->request->uri(),
                $this->container->request->method()
            );
    }
}
