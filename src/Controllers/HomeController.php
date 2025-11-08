<?php

namespace App\Controllers;

use App\Kernal\Controller\Controller;
use App\Kernal\View\View;

class HomeController extends Controller
{
    public function index(): void
    {
        $this ->view('home');
    }
}