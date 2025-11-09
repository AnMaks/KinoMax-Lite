<?php

namespace App\Kernal\View;

use App\Kernal\Exceptions\ViewNotFoundException;

class View
{
    public function page(string $name): void
    {

        $viewPath = APP_PATH . "/views/pages/$name.php";

        if(!file_exists($viewPath)){
            throw new ViewNotFoundException("View $name not found");
        }

        extract(['view' => $this]);

        include_once $viewPath;
    }

    public function component(string $name): void
    {
        $componentsPath = APP_PATH . "/views/components/$name.php";

        if(!file_exists($componentsPath)){
            echo "Component $name not found";
            return;
        }
        include_once $componentsPath;
    }
}