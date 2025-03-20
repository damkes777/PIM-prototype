<?php

namespace App\Livewire\Product;

use App\Livewire\Forms\ProductForm;
use Illuminate\View\View;
use Livewire\Component;

abstract class AbstractProductForm extends Component
{
    public ProductForm $form;

    public abstract function submit(): void;

    public function render(): View
    {
        return view('livewire.product.form');
    }
}