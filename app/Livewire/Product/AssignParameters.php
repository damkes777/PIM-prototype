<?php

namespace App\Livewire\Product;

use App\Models\Product;
use Illuminate\View\View;
use Livewire\Component;

class AssignParameters extends Component
{
    public Product $product;

    public function render(): View
    {
        return view('livewire.product.assign-parameters');
    }
}