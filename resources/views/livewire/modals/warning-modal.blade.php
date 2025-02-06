<x-wire-modal>
    <x-slot:title>
        {{ $title }}
    </x-slot:title>
    <div>
        {{ $content }}
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