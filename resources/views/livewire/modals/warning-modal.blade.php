<x-wire-modal>
    <x-slot:title>
        {{ __($title) }}
    </x-slot:title>
    <div class="w-full">
        <div class="flex w-full justify-center">
            <div class="bg-yellow-100/80 px-3 py-2 rounded-full">
                <span class="text-3xl text-yellow-400">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                </span>

            </div>
        </div>
        <div class="mt-3">
            <p class="text-center">{{ __($content) }}</p>
        </div>
    </div>
    <x-slot:buttons>
        <x-secondary-button wire:click="dispatch('closeModal')">
            {{ __('Cancel') }}
        </x-secondary-button>
        <x-primary-button wire:click="submit">
            {{ __('Submit') }}
        </x-primary-button>
    </x-slot:buttons>
</x-wire-modal>