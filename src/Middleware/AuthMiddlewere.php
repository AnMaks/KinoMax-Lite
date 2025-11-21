<?php

namespace App\Middleware;

use App\Kernal\Middleware\AbstractMiddlewere;


class AuthMiddlewere extends AbstractMiddlewere
{
    public function handle(): void
    {
        if (! $this ->auth ->check()){
            $this ->redirect ->to('/login');
        }
    }
}