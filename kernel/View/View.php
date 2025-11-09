<?php

namespace App\Kernal\View;

use App\Kernal\Exceptions\ViewNotFoundException;
use App\Kernal\Session\Session;

class View
{
    public function __construct(
            private Session $session,
        )
        {
            
        }
    
    public function page(string $name): void
    {
        $viewPath = APP_PATH . "/views/pages/$name.php";

        if(!file_exists($viewPath)){
            throw new ViewNotFoundException("View $name not found");
        }

        extract($this ->defaulData());

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

    private function defaulData(): array {
        return [
            'view' => $this,
            'session' => $this -> session,
        ];
    }
}