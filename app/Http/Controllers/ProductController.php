<?php

namespace App\Http\Controllers;

use App\Services\ProductServices\ProductService;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function __construct(
        protected ProductService $productService
    ) {
    }

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
        $product = $this->productService->find($id);

        return view('product.edit', ['product' => $product]);
    }

    public function assignCategory(int $id): View
    {
        $product = $this->productService->find($id);

        return view('product.assign-category', ['product' => $product]);
    }

    public function assignParameters(int $id): View
    {
        $product = $this->productService->find($id);

        return view('product.assign-parameters', ['product' => $product]);
    }
}