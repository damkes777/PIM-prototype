<div class="flex gap-2">
    <x-icon-button wire:click="edit({{ $row->id }})"
                   :icon="'fa-solid fa-pen-to-square'"/>
    <x-icon-button wire:click="delete({{ $row->id }})"
                   wire:confirm="Are you sure you want to delete this post?"
                   :icon="'fa-solid fa-trash'"/>
</div>