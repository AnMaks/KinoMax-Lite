<?php

namespace App\Controllers;

use App\Kernal\Controller\Controller;
use App\Services\CategoriesService;

class AdminContoller extends Controller
{
    public function index(): void
    {
        $categories = new CategoriesService($this ->db());
        $this ->view('admin/index', [
            'categories' => $categories ->all()
        ]);
    }
}