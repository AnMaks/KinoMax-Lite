<?php

namespace App\Controllers;

use App\Kernal\View\View;

class MoviesController
{
    public function index(): void
    {
        $view = new View();
        
        $view ->page('movies');
    }
}