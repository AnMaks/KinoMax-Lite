<?php

namespace App\Kernal\Container;

use App\Kernal\Http\Redirect;
use App\Kernal\Http\Request;
use App\Kernal\Router\Router;
use App\Kernal\Session\Session;
use App\Kernal\Validator\Validator;
use App\Kernal\View\View;

class Container
{

    public readonly Request $request;

    public readonly Router $router;

    public readonly View $view;

    public readonly Validator $validator;
    
    public readonly Redirect $redirect;

    public readonly Session $session;

    public function __construct()
    {
     $this -> registerService();   
    }

    private function registerService(): void
    {
        $this ->request = Request::createFromGlobal();
        $this ->view = new View();
        $this ->validator = new Validator();
        $this ->request->setValidator($this ->validator);
        $this ->redirect = new Redirect();
        $this ->session = new Session();
        $this ->router = new Router($this ->view, $this ->request, $this ->redirect,$this ->session);
    }
}