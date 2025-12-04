<?php

namespace App\Controllers;

use App\Kernal\Controller\Controller;
use App\Kernal\View\View;
use App\Services\MoviesService;

class HomeController extends Controller
{
    public function index(): void
    {
        $movies = new MoviesService($this ->db());
        $this ->view('home', [
            'movies' => $movies ->new(),
        ]);
    }
}