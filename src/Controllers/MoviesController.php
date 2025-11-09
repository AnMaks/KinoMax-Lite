<?php

namespace App\Controllers;

use App\Kernal\Controller\Controller;
use App\Kernal\View\View;

class MoviesController extends Controller
{
    public function index(): void
    {
        $this->view('movies');
    }

    public function add(): void
    {
        $this->view('admin/movies/add');
    }

    public function store()
    {
        dd($this ->request() -> input('name'));
    }
}