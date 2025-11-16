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
        $username = $this->request()->input('email'); // обычный пароль
        $password = $this->request()->input('password'); // сырой пароль

        if ($this->auth()->attempt($username, $password)) {
            echo "Успешный вход!";
            dd($_SESSION);
        } else {
            echo "Неправильный логин или пароль";
        }
    }
}