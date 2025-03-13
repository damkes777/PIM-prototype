<div>
    <div class="flex justify-between mb-2 mx-1">
        <h3 class="text-lg font-semibold">{{ __('Files') }}</h3>
        <div>
            <x-text-input wire:model.live.debounce.500ms="query" placeholder="{{ __('search') }}"/>
        </div>
    </div>

    <div class="flex flex-col gap-2">
        @foreach($files as $file)
            <div class="flex justify-between py-1 px-3  border rounded-md shadow-sm">
                <div class="flex flex-col">
                    <span class="text-sm">{{ $file->name }}</span>
                    <span class="text-xs text-gray-400">{{ __('UUID: ') . $file->uuid }}</span>
                </div>
                <div class="flex justify-center gap-3 mr-5">
                    @if($file->is_processing)
                        <span class="content-center"><i class="fa-solid fa-spinner animate-spin"></i></span>
                    @else
                        <button class="text-zinc-500 hover:text-zinc-700 p-1"><i class="fa-solid fa-play"></i></button>
                    @endif
                    <button wire:click="delete({{ $file }})"  class="text-zinc-500 hover:text-zinc-700 p-1"><i class="fa-solid fa-trash"></i></button>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-3">
        {{ $files->links() }}
    </div>
</div>