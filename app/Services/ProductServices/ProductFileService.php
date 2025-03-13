<?php

namespace App\Services\ProductServices;

use App\Exceptions\CreateExampleFileException;
use App\Models\ProductFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
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

    public function storeFile(array $file)
    {
        $fileUuid = Str::uuid();

        $this->moveFile($file, $fileUuid);

        return ProductFile::query()
                          ->create([
                              'uuid' => $fileUuid,
                              'name' => $file['name'],
                              'path' => 'products/' . $fileUuid . '/' . $file['name'],
                          ]);
    }

    public function deleteFile(ProductFile $productFile): void
    {
        Storage::disk('public')
               ->delete($productFile->path);

        $productFile->delete();
    }

    public function saveFile(string $xml, string $fileName): bool
    {
        return Storage::disk('public')
                      ->put('products/' . $fileName, $xml);
    }

    public function downloadFile(string $fileName): StreamedResponse
    {
        return Storage::disk('public')
                      ->download('products/' . $fileName);
    }

    protected function moveFile(array $file, string $fileUuid): void
    {

        $fileContent = Storage::disk('local')
                              ->get('livewire-tmp/' . $file['tmpFilename']);

        Storage::disk('public')
               ->put('products/' . $fileUuid . '/' . $file['name'], $fileContent);
        Storage::disk('local')
               ->delete('livewire-tmp/' . $file['tmpFilename']);
    }
}