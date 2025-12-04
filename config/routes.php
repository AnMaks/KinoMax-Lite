<?php

use App\Controllers\AdminContoller;
use App\Controllers\CategoriesController;
use App\Kernal\Router\Route;
use App\Controllers\HomeController;
use App\Controllers\LoginController;
use App\Controllers\MoviesController;
use App\Controllers\RegisterController;

return [
    Route::get('/', [HomeController::class, 'index']),
    Route::get('/register', [RegisterController::class, 'index']),
    Route::post('/register', [RegisterController::class, 'register']),
    Route::get('/login', [LoginController::class, 'index']),
    Route::post('/login', [LoginController::class, 'login']),
    Route::post('/logout', [LoginController::class, 'logout']),
    Route::get('/admin', [AdminContoller::class, 'index']),
    Route::get('/admin/categories/add', [CategoriesController::class, 'create']),
    Route::post('/admin/categories/add', [CategoriesController::class, 'store']),
    Route::post('/admin/categories/destroy', [CategoriesController::class, 'destroy']),
    Route::post('/admin/categories/update', [CategoriesController::class, 'update']),
    Route::get('/admin/categories/update', [CategoriesController::class, 'edit']),
    Route::get('/movie', [MoviesController::class, 'show']),
    Route::get('/admin/movies/add', [MoviesController::class, 'create']),
    Route::post('/admin/movies/add', [MoviesController::class, 'store']),
    Route::post('/admin/movies/destroy', [MoviesController::class, 'destroy']),
    Route::post('/admin/movies/update', [MoviesController::class, 'update']),
    Route::get('/admin/movies/update', [MoviesController::class, 'edit']),
];