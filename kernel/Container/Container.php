<?php

namespace App\Kernal\Container;

use App\Kernal\Config\Config;
use App\Kernal\Config\ConfigInteface;
use App\Kernal\DataBase\DataBase;
use App\Kernal\DataBase\DataBaseInteface;
use App\Kernal\Http\Redirect;
use App\Kernal\Http\RedirectInterface;
use App\Kernal\Http\Request;
use App\Kernal\Http\RequestInterface;
use App\Kernal\Router\Router;
use App\Kernal\Router\RouterInterface;
use App\Kernal\Session\Session;
use App\Kernal\Session\SessionInterface;
use App\Kernal\Validator\Validator;
use App\Kernal\Validator\ValidatorInterface;
use App\Kernal\View\View;
use App\Kernal\View\ViewInterface;

class Container
{

    public readonly RequestInterface $request;

    public readonly RouterInterface $router;

    public readonly ViewInterface $view;

    public readonly ValidatorInterface $validator;
    
    public readonly RedirectInterface $redirect;

    public readonly SessionInterface $session;

    public readonly ConfigInteface $config;

    public readonly DataBaseInteface $data_base;

    public function __construct()
    {
     $this -> registerService();   
    }

    private function registerService(): void
    {
        $this ->request = Request::createFromGlobal();
        $this ->validator = new Validator();
        $this ->request->setValidator($this ->validator);
        $this ->redirect = new Redirect();
        $this ->session = new Session();
        $this ->view = new View($this -> session);
        $this -> config = new Config();
        $this -> data_base = new DataBase($this -> config);
        $this ->router = new Router($this ->view, $this ->request, $this ->redirect,$this ->session, $this ->data_base);
        
    }
}