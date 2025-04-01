<?php

namespace App\Livewire\Product;

use App\Models\Product;
use App\Services\GenerateServices\GenerateProductDescriptionService;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\View\View;
use JsonException;
use Livewire\Component;

class ProductDescription extends Component
{
    public Product $product;

    public $description;

    public function render(): View
    {
        return view('livewire.product.product-description');
    }

    /**
     * @throws GuzzleException
     * @throws JsonException
     */
    public function generateDescription(): void
    {
        $service = app(GenerateProductDescriptionService::class);

        $this->description = $service->generate($this->product);
    }

    public function hasParameters(): bool
    {
        if ($this->product->parameters === null) {
            return false;
        }

        $parameters = unserialize($this->product->parameters);

        return !empty($parameters);
    }

    public function hasCategory(): bool
    {
        return $this->product->category()
                             ->exists();
    }

    public function assignCategory(): void
    {
        $this->redirectRoute('products.assignCategory', ['id' => $this->product->id]);
    }

    public function assignParameters(): void
    {
        $this->redirectRoute('products.assignParameters', ['id' => $this->product->id]);
    }
}