<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class CategoryController extends Controller
{
    public function list(): View
    {
        return view('category.index');
    }
}