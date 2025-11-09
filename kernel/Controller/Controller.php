<?php

namespace App\Kernal\Controller;

use App\Kernal\Http\Request;
use App\Kernal\View\View;

abstract class Controller
{
    private View $view;

    private Request $request;

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
}