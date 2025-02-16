<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ParameterController;

Route::middleware(['auth'])
     ->group(function () {
         Route::view('/', 'dashboard')
              ->name('dashboard');

         Route::view('profile', 'profile')
              ->name('profile');

         Route::controller(CategoryController::class)
              ->prefix('categories')
              ->group(function () {
                  Route::get('/', 'list')
                       ->name('categories.list');
              });

         Route::controller(ParameterController::class)
              ->prefix('parameters')
              ->group(function () {
                  Route::get('/', 'list')
                       ->name('parameters.name');
                  Route::get('/create', 'create')
                       ->name('parameters.create');
              });
     });

require __DIR__ . '/auth.php';
