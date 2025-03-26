@if($this->hasCategory($row))
    <span class="text-sm mx-2">{{ $this->getCategoryPath($row->category_id) }}</span>
    <span wire:click="assignCategory({{ $row->id }})"
          class="text-zinc-500/50 hover:text-zinc-800 p-1 text-sm">
        <i class="fa-solid fa-pen-to-square"></i>
    </span>
@else
    <x-secondary-button wire:click="assignCategory({{ $row->id }})" class="ml-2">
        {{ __('assign') }}
    </x-secondary-button>
@endif
