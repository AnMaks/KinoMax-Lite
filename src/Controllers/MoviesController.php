<?php

namespace App\Controllers;

use App\Kernal\Controller\Controller;
use App\Kernal\Http\Redirect;
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
        $file = $this ->request() ->file('image');

        dd($file ->move('movies'));
        
        $validation = $this->request()->validate(['name' => ['required', 'min:3', 'max:50']]);

        if (! $validation) {
            foreach ($this->request()->errors() as $field => $errors) {
                $this->session()->set($field, $errors);
            }

            $this->redirect('/admin/movies/add');
        }
        $id = $this ->db() ->inserta('movies',[
            'name' => $this ->request()->input('name')
        ]);

        dd($id);

        
    }
}