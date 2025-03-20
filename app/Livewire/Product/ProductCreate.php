<?php

namespace App\Livewire\Product;

class ProductCreate extends AbstractProductForm
{
    public function submit(): void
    {
        $this->form->create();
    }
}