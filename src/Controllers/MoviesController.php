<?php

namespace App\Controllers;

use App\Kernal\Controller\Controller;
use App\Kernal\View\View;

class MoviesController extends Controller
{
    public function index(): void
    {
        $this -> view('movies');
    }
}