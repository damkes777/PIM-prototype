<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class ProductController extends Controller
{
    public function list(): View
    {
        return view('product.list');
    }
}