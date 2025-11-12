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
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8']
        ]);

        if(! $validation){
             foreach ($this->request()->errors() as $field => $errors) {
                $this->session()->set($field, $errors);
            }

            $this->redirect('/register');
        }

        $usersId = $this ->db() ->inserta('users', [
            'email' => $this ->request()->input('email'),
            'password' => password_hash($this ->request()->input('password'),PASSWORD_DEFAULT)
        ]);

        dd("ADD IN BD $usersId");
    }
    
}