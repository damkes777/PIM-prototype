@if($this->hasCategory($row))
    <span>Category</span>
@else
    <x-secondary-button wire:click="assignCategory({{ $row->id }})" class="ml-1" >
        {{ __('assign') }}
    </x-secondary-button>
@endif
