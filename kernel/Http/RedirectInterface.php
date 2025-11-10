<?php

namespace App\Kernal\Http;


interface RedirectInterface
{
    public function to(string $url);
}