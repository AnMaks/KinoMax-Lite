<?php

use App\Kernal\Router\Route;
use App\Middleware\AuthMiddlewere;
use App\Controllers\HomeController;
use App\Controllers\LoginController;
use App\Controllers\MoviesController;
use App\Controllers\RegisterController;
use App\Middleware\GuestMiddlewere;

return [
    Route::get('/home',[HomeController::class, 'index']),
    Route::get('/movies',[MoviesController::class, 'index']),
    Route::get('/admin/movies/add',[MoviesController::class, 'add'], [AuthMiddlewere::class]),
    Route::post('/admin/movies/add',[MoviesController::class, 'store']),
    Route::get('/register',[RegisterController::class, 'index'], [GuestMiddlewere::class]),
    Route::post('/register',[RegisterController::class, 'register']),
    Route::get('/login',[LoginController::class, 'index'], [GuestMiddlewere::class]),
    Route::post('/login',[LoginController::class, 'login']),
    Route::post('/logout',[LoginController::class, 'logout']),
];