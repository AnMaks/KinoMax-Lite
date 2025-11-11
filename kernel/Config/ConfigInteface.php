<?php

namespace App\Kernal\Config;


interface ConfigInteface
{


    public function get(string $key, $default = null): mixed;

    
}