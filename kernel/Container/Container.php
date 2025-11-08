<?php

namespace App\Kernal\Container;

use App\Kernal\Http\Request;
use App\Kernal\Router\Router;

class Container
{

    public readonly Request $request;

    public readonly Router $router;

    public function __construct()
    {
     $this -> registerService();   
    }

    private function registerService(): void
    {
        $this ->router = new Router();
        $this ->request = Request::createFromGlobal();
    }
}