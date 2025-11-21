<?php

namespace App\Kernal\Middleware;


interface MiddlewareInterface
{
    public function check(array $middleware =[]): void;
}