<?php

namespace App\Kernal\Router;



interface RouterInterface
{
    public function dispatch(string $uri, string $method): void;
}