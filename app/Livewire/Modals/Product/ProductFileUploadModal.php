<?php

namespace App\Livewire\Modals\Product;

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
        //
    }

    public function cancel()
    {
        //
    }
}