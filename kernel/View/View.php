<?php

namespace App\Kernal\View;



class View
{
    public function page(string $name): void
    {
        include_once APP_PATH . "/views/pages/$name.php";
    }
}