<?php

namespace App\Controllers;

class MoviesController
{
    public function index(): void
    {
        include_once APP_PATH . '/views/pages/movies.php';
    }
}