<?php

namespace App\Livewire\Modals\Product;

use App\Models\Parameter;
use App\Models\ParameterValue;
use App\Models\Product;
use Illuminate\View\View;
use LivewireUI\Modal\ModalComponent;

class ProductParametersModal extends ModalComponent
{
    public Product $product;
    public $parameters = [];

    public function mount(int $productId): void
    {
        $this->product    = Product::find($productId);
        $this->parameters = unserialize($this->product->parameters);
    }

    public function render(): View
    {
        return view('livewire.modals.product.product-parameters-modal');
    }

    public function getParameterName(int $parameterId): string
    {
        $parameter = Parameter::query()
                              ->with('names')
                              ->find($parameterId);

        return $parameter->english_name;
    }

    public function getValueName(int $valueId): string
    {
        $value = ParameterValue::query()
                                   ->with('names')
                                   ->find($valueId);

        return $value->english_name;
    }
}