<?php

namespace App\Kernal\Controller;

use App\Kernal\DataBase\DataBaseInteface;
use App\Kernal\Http\Redirect;
use App\Kernal\Http\RedirectInterface;
use App\Kernal\Http\Request;
use App\Kernal\Http\RequestInterface;
use App\Kernal\Session\Session;
use App\Kernal\Session\SessionInterface;
use App\Kernal\View\View;
use App\Kernal\View\ViewInterface;

abstract class Controller
{
    private ViewInterface $view;

    private RequestInterface $request;

    private RedirectInterface $redirect;

    private SessionInterface $session;

    private DataBaseInteface $database;

    public function request(): RequestInterface
    {
        return $this->request;
    }

    public function setRequest(RequestInterface $request): void
    {
        $this->request = $request;
    }

    public function view(string $name): void
    {
        $this->view->page($name);
    }

    public function setView(ViewInterface $view): void
    {
        $this->view = $view;
    }

    public function setRedirect(RedirectInterface $redirect): void
    {
        $this->redirect = $redirect;
    }

    public function redirect(string $url)
    {
        return $this->redirect->to($url);
    }

    public function setSession(SessionInterface $session): void
    {
        $this ->session = $session;
    }

    public function session(): SessionInterface
    {
        return $this ->session;    
    }

    public function db(): DataBaseInteface
    {
        return $this->database;
    }

    public function setDatabase(DataBaseInteface $database): void
    {
        $this->database = $database;
    }
}