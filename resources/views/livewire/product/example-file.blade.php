<?php

use Livewire\Volt\Component;

new class extends Component {
    public function downloadExampleFile()
    {
        //
    }
}

?>

<div wire:click="downloadExampleFile" class="w-[250px] py-2 px-4 rounded-md border hover:bg-zinc-50 cursor-pointer shadow-md">
    <div class="flex items-center justify-between">
        <h3 class="font-semibold">{{ __('product.cards.example.title') }}</h3>
        <i class="fa-solid fa-file-arrow-down"></i>
    </div>
    <div class="mt-2">
        <p class="text-sm text-zinc-400">{{ __('product.cards.example.description') }}</p>
    </div>
</div>
