<div>
    @if($this->hasParameters() && $this->hasCategory())
        <div class="flex gap-3 mb-8">
            @foreach($this->getLanguages() as $language)
                <button wire:click="changeTargetLanguage({{ json_encode($language->isoCode()) }})"
                        @class([
                            'py-2 px-4 text-sm uppercase rounded-md hover:bg-zinc-100 hover:text-zinc-700',
                            'text-zinc-700 font-semibold' => $this->isTargetLanguage($language->isoCode()),
                            'text-zinc-400' => !$this->isTargetLanguage($language->isoCode()),
                        ])>
                    {{ $language->isoName() }}
                </button>
            @endforeach
        </div>
        <form>
            <div class="w-full mb-4 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
                <div class="px-4 py-2 bg-white rounded-t-lg dark:bg-gray-800">
                    <label for="description" class="sr-only">{{ __('Product description') }}</label>
                    <textarea wire:model.live="descriptions.{{ $this->targetLanguage }}" id="description" rows="4" class="w-full
                    px-0
                    text-sm
                    text-gray-900
                    bg-white
                    border-0
                dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400"
                              placeholder="Write a description..." required></textarea>
                </div>
                <div class="flex items-center justify-between px-3 py-2 border-t dark:border-gray-600 border-gray-200">
                    <div class="flex">
                        <div>
                            <x-secondary-button wire:click="generateDescription">
                                {{ __('Generate description') }}
                            </x-secondary-button>
                        </div>
                        <div wire:loading wire:target="generateDescription" class="flex justify-center items-center ml-3 gap-2">
                            <i class="fa-solid fa-spinner animate-spin"></i> {{ __('generation...') }}
                        </div>
                    </div>
                    <div>
                        @if(!empty($this->descriptions['en']))
                            <span wire:loading wire:target="translate">{{ __('Translate...') }}</span>
                            <x-secondary-button wire:click="translate">
                                {{ __('Translate') }}
                            </x-secondary-button>
                        @endif
                    </div>
                </div>
            </div>
            <div class="flex flex-row-reverse">
                <x-primary-button>
                    {{ __('Save') }}
                </x-primary-button>
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