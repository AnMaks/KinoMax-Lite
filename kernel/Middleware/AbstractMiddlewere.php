<?php

namespace App\Kernal\Middleware;

use App\Kernal\Auth\AuthInterface;
use App\Kernal\Http\RedirectInterface;
use App\Kernal\Http\RequestInterface;

abstract class AbstractMiddlewere
{
    public function __construct(
        protected RequestInterface $request,
        protected AuthInterface $auth,
        protected RedirectInterface $redirect,
    )
    {
    }

    abstract public function handle(): void;
}