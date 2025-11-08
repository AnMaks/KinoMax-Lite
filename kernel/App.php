<?php

namespace App\Kernal;

use App\Kernal\Http\Request;
use App\Kernal\Router\Router;

class App
{

    public function run(): void
    {
        $router = new Router();
        $request = Request::createFromGlobal();

        //dd($_SERVER);

        $router->dispatch($request->uri(), $request ->method());
    }
}