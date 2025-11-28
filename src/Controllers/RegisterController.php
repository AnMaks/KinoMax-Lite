<?php

namespace App\Controllers;

use App\Kernal\Controller\Controller;

class RegisterController extends Controller
{
    public function index()
    {
        $this ->view('register');
    }

    public function register()
    {

        $validation = $this ->request() ->validate([
            'name' => ['required','max:255'],
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8', 'confirmed']
        ]);

        if(! $validation){
             foreach ($this->request()->errors() as $field => $errors) {
                $this->session()->set($field, $errors);
            }

            $this->redirect('/register');
        }

        $this ->db() ->inserta('users', [
            'name' => $this ->request()->input('name'),
            'email' => $this ->request()->input('email'),
            'password' => password_hash($this ->request()->input('password'),PASSWORD_DEFAULT)
        ]);

        $this ->redirect('/');
    }
    
}