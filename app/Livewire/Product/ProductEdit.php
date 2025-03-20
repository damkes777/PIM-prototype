<?php

namespace App\Livewire\Product;

use App\Models\Product;

class ProductEdit extends AbstractProductForm
{
    public function mount(Product $product): void
    {
        $this->form->product = $product;
        $this->form->setProduct();
    }

    public function submit(): void
    {
        $this->form->edit();
    }
}