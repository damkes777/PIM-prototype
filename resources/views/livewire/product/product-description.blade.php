<div>
    @if($this->hasParameters() && $this->hasCategory())
        <form>
            <div class="w-full mb-4 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
                <div class="px-4 py-2 bg-white rounded-t-lg dark:bg-gray-800">
                    <label for="description" class="sr-only">{{ __('Product description') }}</label>
                    <textarea wire:model.live="description" id="description" rows="4" class="w-full px-0 text-sm text-gray-900
                    bg-white
                    border-0
                dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400"
                              placeholder="Write a description..." required></textarea>
                </div>
                <div class="flex items-center justify-between px-3 py-2 border-t dark:border-gray-600 border-gray-200">
                    <x-secondary-button wire:click="generateDescription">
                        {{ __('Generate description') }}
                    </x-secondary-button>
                </div>
            </div>
        </form>
    @else
        <div class="flex flex-col">
            <p class="text-center">{{ __('A product must have parameters and categories assigned before its description can
             be created
            .') }}</p>
            <div class="flex justify-center mt-8 gap-8">
                @if(!$this->hasParameters())
                    <x-secondary-button wire:click="assignParameters">{{ __('Assign parameters') }}</x-secondary-button>
                @endif
                @if(!$this->hasCategory())
                        <x-secondary-button wire:click="assignCategory">{{ __('Assign category') }}</x-secondary-button>
                @endif
            </div>
        </div>
    @endif
</div>