<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class ProductController extends Controller
{
    public function list(): View
    {
        return view('product.list');
    }

    public function create(): View
    {
        return view('product.create');
    }

    public function edit(int $id): View
    {
        return view('product.edit');
    }
}