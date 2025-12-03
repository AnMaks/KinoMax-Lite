<?php

namespace App\Controllers;

use App\Kernal\Controller\Controller;
use App\Services\CategoriesService;
use App\Services\MoviesService;

class AdminContoller extends Controller
{
    public function index(): void
    {
        $categories = new CategoriesService($this ->db());
        $movies = new MoviesService($this ->db());

        
        $this ->view('admin/index', [
            'categories' => $categories ->all(),
            'movies' => $movies ->all()
        ]);
    }
}