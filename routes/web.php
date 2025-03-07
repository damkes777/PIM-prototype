<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ParameterController;
use App\Http\Controllers\ProductController;

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
                       ->name('parameters.list');
                  Route::get('/create', 'create')
                       ->name('parameters.create');
                  Route::get('/edit/{id}', 'edit')
                       ->name('parameters.edit');
              });

         Route::controller(ProductController::class)
              ->prefix('products')
              ->group(function () {
                  Route::get('/', 'list')
                       ->name('products.list');
              });
     });

require __DIR__ . '/auth.php';
