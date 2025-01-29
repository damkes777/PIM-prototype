<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

Route::middleware(['auth'])
     ->group(function () {
         Route::view('/', 'dashboard')
              ->name('dashboard');

         Route::view('profile', 'profile')
              ->name('profile');

         Route::controller(CategoryController::class)
              ->prefix('category')
              ->group(function () {
                  Route::get('/', 'list')
                       ->name('category.list');
              });
     });

require __DIR__ . '/auth.php';
