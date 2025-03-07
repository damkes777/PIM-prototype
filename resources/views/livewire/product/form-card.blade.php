<?php

use Livewire\Volt\Component;

new class extends Component {
    public function redirectToForm(): void
    {
        $this->redirectRoute('products.create');
    }
}

?>

<div wire:click="redirectToForm" class="w-[250px] py-2 px-4 rounded-md border hover:bg-zinc-50 cursor-pointer shadow-md">
    <div class="flex items-center justify-between">
        <h3 class="font-semibold">{{ __('product.cards.form.title') }}</h3>
        <i class="fa-solid fa-arrow-right"></i>
    </div>
    <div class="mt-2">
        <p class="text-sm text-zinc-400">{{ __('product.cards.form.description') }}</p>
    </div>
</div>
