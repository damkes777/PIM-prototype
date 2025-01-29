<div>
    <div class="flex p-2 justify-between bg-zinc-200/50">
        <h2 class="p-1 ml-2 text-center text-lg font-medium text-zinc-600">
            {{ $title ?? '' }}
        </h2>
        <button wire:click="dispatch('closeModal')"
                class="text-zinc-600 p-1 mr-2">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>
    <div class="flex p-5">
        {{ $slot }}
    </div>
    <div class="flex flex-row-reverse gap-2 m-2">
        {{ $buttons ?? '' }}
    </div>
</div>