<?php

define('APP_PATH', dirname(__DIR__));


require_once dirname(__DIR__) . '/vendor/autoload.php';

use App\Kernal\App;

$app = new App();

$app->run();