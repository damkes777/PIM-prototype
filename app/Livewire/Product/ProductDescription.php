<?php

namespace App\Livewire\Product;

use App\Enums\Languages;
use App\Models\Product;
use App\Services\GenerateServices\GenerateProductDescriptionService;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\View\View;
use JsonException;
use Livewire\Component;

class ProductDescription extends Component
{
    public Product $product;

    public $targetLanguage = 'en';
    public $descriptions = [];

    public function mount(): void
    {
        foreach ($this->getLanguages() as $language) {
            $this->descriptions[$language->isoCode()] = '';
        }
    }

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

        $this->descriptions['en'] = $service->generate($this->product);
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

    public function getLanguages(): array
    {
        return Languages::cases();
    }

    public function changeTargetLanguage($targetLanguage): void
    {
        $this->targetLanguage = $targetLanguage;
    }

    public function isTargetLanguage(string $targetLanguage): bool
    {
        return $this->targetLanguage === $targetLanguage;
    }
}