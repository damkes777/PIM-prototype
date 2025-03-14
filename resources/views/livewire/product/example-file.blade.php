<?php

use Livewire\Volt\Component;
use App\Services\ProductServices\ProductFileService;

new class extends Component {
    public function downloadExampleFile()
    {
        $service  = app(ProductFileService::class);
        $fileName = $service->createExampleFile();

        if (empty($fileName)) {
            return null;
        }

        return $service->downloadFile($fileName);
    }
}

?>

<div wire:click="downloadExampleFile"
     class="w-[250px] py-2 px-4 rounded-md border hover:bg-zinc-50 cursor-pointer shadow-md">
    <div class="flex items-center justify-between">
        <div class="flex items-center">
            <h3 class="font-semibold">{{ __('product.cards.example.title') }}</h3>
            <span wire:loading wire:target="downloadExampleFile" class="text-zinc-400 text-sm ml-2">
                <i class="fa-solid fa-spinner animate-spin"></i>
            </span>
        </div>
        <i class="fa-solid fa-file-arrow-down"></i>
    </div>
    <div class="mt-2">
        <p class="text-sm text-zinc-400">{{ __('product.cards.example.description') }}</p>
    </div>
</div>
