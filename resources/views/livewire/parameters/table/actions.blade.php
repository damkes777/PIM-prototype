<x-secondary-button wire:click="edit({{ $value }})">
    {{ __('Edit') }}
</x-secondary-button>
<x-secondary-button wire:click="delete({{ $value }})">
    {{ __('Delete') }}
</x-secondary-button>