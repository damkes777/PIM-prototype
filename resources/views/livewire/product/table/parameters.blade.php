@if($this->hasParameters($row))
    <x-secondary-button wire:click="showProductParameters({{ $row->id }})" class="ml-1">
        {{ __('Show') }}
    </x-secondary-button>
    <x-secondary-button class="ml-1" wire:click="assignParameters({{ $row->id }})">
        {{ __('assign') }}
    </x-secondary-button>
@else
    <x-secondary-button class="ml-1" wire:click="assignParameters({{ $row->id }})">
        {{ __('assign') }}
    </x-secondary-button>
@endif