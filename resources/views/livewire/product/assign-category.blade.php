<div>
    <div class="flex flex-col gap-3">
        <div class="flex items-center">
            <x-text-input wire:model.live.debounce.500ms="search" placeholder="{{ __('search') }}"/>
            @if($this->selectedCategory !== null)
                <span class="ml-5">{{ __('Selected: ') . $this->getSelectedCategoryName() }}</span>
            @endif
        </div>
        <div class="flex gap-5">
            @foreach($categories as $category)
                <div class="w-[250px] p-2 border rounded-md text-sm">
                    <div class="flex justify-between">
                        <span class="font-semibold">{{ $category->english_name }}</span>
                        <input wire:model.live="selectedCategory"
                               value="{{ $category->id }}"
                               type="radio"
                               class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
                    </div>
                    <div class="flex flex-col mt-5 text-xs">
                        <span>{{ __('Path: ') }}</span>
                        <span>{{ $this->getCategoryPath($category->id) }}</span>
                    </div>
                </div>
            @endforeach
        </div>
        <div>
            {{ $categories->links() }}
        </div>
    </div>
    <div class="flex flex-row-reverse mt-8 gap-3">
        <x-primary-button wire:click="save">{{ __('Save') }}</x-primary-button>
        <x-secondary-button wire:click="cancel">{{ __('Cancel') }}</x-secondary-button>
    </div>
</div>