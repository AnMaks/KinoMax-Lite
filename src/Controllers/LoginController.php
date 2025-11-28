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
        $email = $this->request()->input('email'); 
        $password = $this->request()->input('password'); // сырой пароль

        if($this->auth()->attempt($email, $password)){
            $this ->redirect('/');
        }

        $this ->session() ->set('error','Неверный пароль или логин');
        $this ->redirect('/login');
    }

    public function logout()
    {
        $this ->auth()->logout();

        return $this ->redirect('/login');
    }
}