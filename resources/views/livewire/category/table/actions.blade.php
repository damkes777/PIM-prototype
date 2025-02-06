<div>
    <x-secondary-button wire:click="createChildren({{ $value }})">
        {{ __('add node') }}
    </x-secondary-button>
    <x-secondary-button wire:click="delete({{ $value }})">
        {{ __('delete') }}
    </x-secondary-button>
</div>