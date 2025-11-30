<?php

namespace App\Kernal\Controller;

use App\Kernal\Auth\AuthInterface;
use App\Kernal\DataBase\DataBaseInteface;
use App\Kernal\Http\Redirect;
use App\Kernal\Http\RedirectInterface;
use App\Kernal\Http\Request;
use App\Kernal\Http\RequestInterface;
use App\Kernal\Session\Session;
use App\Kernal\Session\SessionInterface;
use App\Kernal\Storage\StorageInterface;
use App\Kernal\View\View;
use App\Kernal\View\ViewInterface;

abstract class Controller
{
    private ViewInterface $view;

    private RequestInterface $request;

    private RedirectInterface $redirect;

    private SessionInterface $session;

    private DataBaseInteface $database;

    private AuthInterface $auth;

    private StorageInterface $storage;

    public function auth(): AuthInterface
    {
        return $this->auth;
    }

    public function setAuth( AuthInterface $auth): void
    {
        $this->auth = $auth;
    }

    public function request(): RequestInterface
    {
        return $this->request;
    }

    public function setRequest(RequestInterface $request): void
    {
        $this->request = $request;
    }

    public function view(string $name, array $data =[]): void
    {
        $this->view->page($name, $data);
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

        public function storage(): StorageInterface
    {
        return $this->storage;
    }

    public function setStorage(StorageInterface $storage): void
    {
        $this->storage = $storage;
    }
}