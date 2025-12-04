<?php

namespace App\Controllers;

use App\Kernal\Controller\Controller;
use App\Kernal\Http\Redirect;
use App\Kernal\Validator\Validator;
use App\Kernal\View\View;
use App\Services\CategoriesService;
use App\Services\MoviesService;

class MoviesController extends Controller
{
    private MoviesService $service;

    public function create(): void
    {
        $categoris = new CategoriesService($this->db());

        $this->view('admin/movies/add', [
            'categories' => $categoris->all()
        ]);
    }

    public function add(): void
    {
        $this->view('admin/movies/add');
    }

    public function store(): void
    {
        $file = $this->request()->file('image');

        //$filePath = $file ->move('movies');

        $validation = $this->request()->validate([
            'name' => ['required', 'min:3', 'max:50'],
            'description' => ['required'],
            'category' => ['required'],
        ]);

        if (! $validation) {
            foreach ($this->request()->errors() as $field => $errors) {
                $this->session()->set($field, $errors);
            }

            $this->redirect('/admin/movies/add');
        }

        $this->service()->store(
            $this->request()->input('name'),
            $this->request()->input('description'),
            $this->request()->file('image'),
            $this->request()->input('category'),
        );

        $this->redirect('/admin');
    }

    public function destroy()
    {
        $this->service()->destroy($this->request()->input('id'));

        $this->redirect('/admin');
    }

    public function edit()
    {
        $categoris = new CategoriesService($this ->db());
        $movie = $this->service()->find($this->request()->input('id'));

        $this->view('/admin/movies/update', [
            'movie' => $movie,
            'categories' => $categoris ->all()
        ]);
    }

    public function update()
    {
        $validation = $this->request()->validate([
            'name' => ['required', 'min:3', 'max:50'],
            'description' => ['required'],
            'category' => ['required'],
        ]);

        if (! $validation) {
            foreach ($this->request()->errors() as $field => $errors) {
                $this->session()->set($field, $errors);
            }

            $this->redirect("/admin/movies/update?id={$this->request()->input('id')}");
        }

        $this->service()->update(
            $this->request()->input('id'),
            $this->request()->input('name'),
            $this->request()->input('description'),
            $this->request()->file('image'),
            $this->request()->input('category'),
        );

        $this->redirect('/admin');
    }

    public function show(): void
    {
        $this ->view('movie', [
            'movie' => $this ->service() ->find($this ->request()->input('id'))
        ]);
    }



    private function service(): MoviesService
    {
        if (! isset($this->service)) {
            $this->service = new MoviesService($this->db());
        }

        return $this->service;
    }
}