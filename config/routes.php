<?php

use App\Controllers\HomeController;
use App\Controllers\MoviesController;
use App\Router\Route;
return [
    Route::get('/home',[HomeController::class, 'index']),
    Route::get('/movies',[MoviesController::class, 'index']),
    Route::get('/test',function(){
        echo "test";}),
];