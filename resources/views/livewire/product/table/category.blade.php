@if($this->hasCategory($row))
    <span class="text-sm ml-2">{{ $this->getCategoryPath($row->category_id) }}</span>
@else
    <x-secondary-button wire:click="assignCategory({{ $row->id }})" class="ml-2">
        {{ __('assign') }}
    </x-secondary-button>
@endif
