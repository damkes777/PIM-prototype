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

         /*
          * Category routes
          */
         Route::controller(CategoryController::class)
              ->prefix('categories')
              ->group(function () {
                  Route::get('/', 'list')
                       ->name('categories.list');
              });

         /*
          * Parameter routes
          */
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

         /*
          * Product routes
          */
         Route::controller(ProductController::class)
              ->prefix('products')
              ->group(function () {
                  Route::get('/', 'list')
                       ->name('products.list');
                  Route::get('/create', 'create')
                       ->name('products.create');
                  Route::get('/edit/{id}', 'edit')
                       ->name('products.edit');
                  Route::get('/{id}/assignParameters', 'assignParameters')
                       ->name('products.assignParameters');
                  Route::get('/{id}/assignCategory', 'assignCategory')
                       ->name('products.assignCategory');
              });
     });

require __DIR__ . '/auth.php';
