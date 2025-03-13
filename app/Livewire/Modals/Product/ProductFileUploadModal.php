<?php

namespace App\Livewire\Modals\Product;

use App\Services\ProductServices\ProductFileService;
use Illuminate\View\View;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class ProductFileUploadModal extends ModalComponent
{
    use WithFileUploads;

    public $file;

    public function render(): View
    {
        return view('livewire.modals.product.product-file-upload-modal');
    }

    public function submitAndProcess()
    {
        //
    }

    public function submit()
    {
        $service = app(ProductFileService::class);

        try {
            $service->storeFile($this->file[0]);
            $this->dispatch('closeModal');
        } catch (\Throwable $exception) {
            debug($exception->getMessage());
        }
    }

    public function cancel()
    {
        //
    }
}