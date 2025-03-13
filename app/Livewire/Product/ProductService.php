<?php

namespace App\Livewire\Product;

use App\Models\Product;

class ProductService
{
    public function createOrUpdate(array $productData, int $fileId): Product
    {
        $product = Product::query()
                          ->updateOrCreate(['sku' => $productData['sku']], [
                              'sku' => $productData['sku'],
                              'ean' => $productData['ean'],
                              'quantity' => $productData['quantity'],
                              'brand' => $productData['brand'],
                              'file_id' => $fileId,
                          ]);

        $this->createNames($product, $productData['name']);
        $this->createPrice($product, $productData['currency'], $productData['price']);

        return $product;
    }

    public function createNames(Product $product, string $name): void
    {
        $product->names()
                ->create([
                    'language' => 'en',
                    'name' => $name,
                ]);
    }

    public function createPrice(Product $product, string $currency, string $price): void
    {
        $product->prices()
                ->create([
                    'currency' => $currency,
                    'price' => $price,
                ]);
    }
}