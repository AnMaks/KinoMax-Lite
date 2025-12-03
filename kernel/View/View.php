<?php

namespace App\Kernal\View;

use App\Kernal\Auth\AuthInterface;
use App\Kernal\Exceptions\ViewNotFoundException;
use App\Kernal\Session\Session;
use App\Kernal\Session\SessionInterface;
use App\Kernal\Storage\StorageInterface;

class View implements ViewInterface
{
    public function __construct(
        private SessionInterface $session,
        private AuthInterface $auth,
        private StorageInterface $storage,
    ) {}

    public function page(string $name, array $data = []): void
    {
        $viewPath = APP_PATH . "/views/pages/$name.php";

        if (!file_exists($viewPath)) {
            throw new ViewNotFoundException("View $name not found");
        }

        extract(array_merge($this->defaulData(), $data));

        include_once $viewPath;
    }

    public function component(string $name, array $data = []): void
    {
        $componentsPath = APP_PATH . "/views/components/$name.php";

        if (!file_exists($componentsPath)) {
            echo "Component $name not found";
            return;
        }

        extract(array_merge($this->defaulData(), $data));

        include $componentsPath;
    }

    private function defaulData(): array
    {
        return [
            'view' => $this,
            'session' => $this->session,
            'auth' => $this->auth,
            'storage' =>$this ->storage,
        ];
    }
}