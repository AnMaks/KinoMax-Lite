<?php

namespace App\Controllers;

use App\Kernal\Controller\Controller;
use App\Kernal\Validator\Validator;
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
        $data = ['name' => 'ww'];
        $rules = ['name' => ['required','min:3','max:255']];

        $validator = new Validator();

        dd($validator ->validate($data, $rules), $validator ->errors());
        dd($this ->request() -> input('name'));
    }
}