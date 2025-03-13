<?php

namespace App\Livewire\Product;

use App\Exceptions\ParseProductFileException;
use App\Models\ProductFile;
use App\Services\ProductServices\ProductFileService;
use Saloon\XmlWrangler\XmlReader;
use Throwable;

class ParseProductFileService
{
    public function __construct(
        protected ProductFileService $productFileService,
        protected ProductService $productService
    ) {
    }

    /**
     * @throws ParseProductFileException
     * @throws Throwable
     */
    public function parseFile(ProductFile $productFile): void
    {
        $file = $this->productFileService->getFile($productFile->path);

        if (empty($file)) {
            throw new ParseProductFileException('File not found');
        }

        $reader = XmlReader::fromString($file);
        $values = $reader->values();

        foreach ($values['products'] as $product) {
            $this->productService->createOrUpdate($product, $productFile->id);
        }
    }
}