<div>
    <div class="flex p-2 justify-between">
        <h2 class="p-1 ml-2 text-sm text-center content-center font-medium text-zinc-400">
            {{ $title ?? '' }}
        </h2>
        <button wire:click="dispatch('closeModal')"
                class="text-zinc-600 py-1 px-2 mr-2">
            <i class="fa-solid fa-xmark text-sm"></i>
        </button>
    </div>
    <div class="flex p-5">
        {{ $slot }}
    </div>
    <div class="flex flex-row-reverse gap-2 m-2">
        {{ $buttons ?? '' }}
    </div>
</div>