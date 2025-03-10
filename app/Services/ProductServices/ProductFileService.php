<?php

namespace App\Services\ProductServices;

use App\Exceptions\CreateExampleFileException;
use Illuminate\Support\Facades\Storage;
use Saloon\XmlWrangler\XmlWriter;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Throwable;

class ProductFileService
{
    public function createExampleFile(): string
    {
        try {
            $writer = new XmlWriter();
            $xml    = $writer->write('products', [
                'product' => [
                    'name' => 'Example product name',
                    'sku' => 'SKU',
                    'ean' => 'EAN',
                    'price' => '10,50',
                    'currency' => 'USD',
                    'quantity' => 1,
                    'brand' => 'Example product brand',
                ],
            ]);

            $status = $this->saveFile($xml, 'example.xml');

            if (!$status) {
                throw new CreateExampleFileException('Failed to create example file');
            }

            return 'example.xml';
        } catch (Throwable $exception) {
            return '';
        }
    }

    public function saveFile(string $xml, string $fileName): bool
    {
        return Storage::disk('public')
                      ->put('products/' . $fileName, $xml);
    }

    public function downloadFile(string $fileName): StreamedResponse
    {
        return Storage::disk('public')
                      ->download(path: 'products/' . $fileName);
    }
}