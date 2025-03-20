<?php

namespace App\Livewire\Forms;

use App\Models\Product;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ProductForm extends Form
{
    public ?Product $product;

    #[Validate('required|string|max:256')]
    public $name;

    #[Validate('required|string|max:256')]
    public $brand;

    #[Validate('required|regex:/^\d{1,3}(,\d{3})*(\.\d{2})?$/')]
    public $price;

    #[Validate('required|string|max:3')]
    public $currency;

    #[Validate('required|numeric')]
    public $quantity;

    #[Validate('required|string|max:256')]
    public $sku;

    #[Validate('required|string|max:256')]
    public $ean;

    public function setProduct(): void
    {
        //
    }

    public function create()
    {
        //
    }

    public function edit()
    {
        //
    }
}