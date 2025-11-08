<?php

namespace App\Controllers;

use App\Kernal\View\View;

class HomeController
{
    public function index(): void
    {
        $view = new View();
        
        $view ->page('home');
    }
}