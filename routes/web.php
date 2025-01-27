<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
     ->middleware(['auth', 'verified'])
     ->name('dashboard');

Route::view('profile', 'profile')
     ->middleware(['auth'])
     ->name('profile');

Route::controller(CategoryController::class)
     ->prefix('/category')
     ->group(function () {
         Route::get('/', 'list')
              ->name('category.list');
     });

require __DIR__ . '/auth.php';
