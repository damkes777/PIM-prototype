@if($this->productHasDescription($row))
    <x-secondary-button wire:click="description({{ $row->id }})">
        {{ __('Edit') }}
    </x-secondary-button>
@else
    <x-secondary-button wire:click="description({{ $row->id }})">
        {{ __('Create') }}
    </x-secondary-button>
@endif