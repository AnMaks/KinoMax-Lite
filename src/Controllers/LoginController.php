<?php

namespace App\Controllers;

use App\Kernal\Controller\Controller;

class LoginController extends Controller
{
    public function index()
    {
        $this->view('login');
    }

    public function login()
    {
        // В контроллере при логине
        $username = $this->request()->input('email'); 
        $password = $this->request()->input('password'); // сырой пароль

        $this->auth()->attempt($username, $password);

        $this ->redirect('/home');
    }

    public function logout()
    {
        $this ->auth()->logout();

        return $this ->redirect('/login');
    }
}