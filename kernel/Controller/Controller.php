<?php

namespace App\Kernal\Controller;

use App\Kernal\Http\Redirect;
use App\Kernal\Http\Request;
use App\Kernal\View\View;

abstract class Controller
{
    private View $view;

    private Request $request;

    private Redirect $redirect;

    public function request(): Request
    {
        return $this ->request;
    }

    public function setRequest(Request $request): void
    {
        $this ->request = $request;
    }

    public function view(string $name): void
    {
        $this->view ->page($name);
    }

    public function setView(View $view): void
    {
        $this ->view = $view;
    }

     public function setRedirect(Redirect $redirect): void
    {
        $this ->redirect = $redirect;
    }

    public function redirect(string $url)
    {
        return $this ->redirect ->to($url);    
    }
}