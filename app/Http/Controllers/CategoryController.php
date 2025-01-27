<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class CategoryController
{
    public function list(): View
    {
        return view('category.index');
    }
}