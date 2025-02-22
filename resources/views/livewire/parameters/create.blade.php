<div class="flex flex-col w-4/5 mx-auto">
    <form wire:submit="save">
        <div class="w-full border-t border-zinc-200">
            <div class="flex py-5 px-8">
                <div class="w-1/2">
                    <h3 class="font-semibold">
                        {{ __('Parameter') }}
                    </h3>
                </div>
                <div class="flex flex-col w-1/2 gap-3">
                    @foreach(\App\Enums\Languages::cases() as $language)
                        <div class="flex flex-col w-full">
                            @if($this->isEnglishLanguage($language->isoCode()))
                                <x-input-label>{{ __('Parameter name ') . "({$language->isoCode()})*" }}</x-input-label>
                            @else
                                <x-input-label>{{ __('Parameter name ') . "({$language->isoCode()})" }}</x-input-label>
                            @endif
                            <x-text-input wire:model="form.parameterNames.{{ $language->isoCode() }}"/>
                            <x-input-error :messages="$errors->get('form.parameterNames.' . $language->isoCode())"/>
                        </div>
                    @endforeach
                    <div class="flex">
                        <x-primary-button wire:click="translateParameterNames()">
                            {{ __('Translate') }}
                        </x-primary-button>
                        <div class="flex justify-center items-center ml-3 gap-2" wire:loading wire:target="translateParameterNames">
                            <i class="fa-solid fa-spinner animate-spin"></i> {{ __('Translation...') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full border-t border-zinc-200">
            <div class="flex py-5 px-8">
                <div class="w-1/2">
                    <h3 class="font-semibold">
                        {{ __('Parameter values') }}
                    </h3>
                </div>
                <div class="flex flex-col w-1/2 gap-5" x-data="{ expandedIndex: 0 }">
                    @foreach($form->valueNames as $key => $valueName)
                        <div class="flex flex-col  gap-3">
                            <div @click="expandedIndex = (expandedIndex === {{ $key }} ? null : {{ $key }} )"
                                 class="flex justify-between px-2 py-1 hover:bg-zinc-200/60 rounded-md transition-colors ease-in-out">
                                <div>
                                    <template x-if="expandedIndex === {{$key}}">
                                        <i class="fa-solid fa-chevron-down"></i>
                                    </template>
                                    <template x-if="expandedIndex !== {{$key}}">
                                        <i class="fa-solid fa-chevron-up"></i>
                                    </template>
                                </div>
                                <div class="font-semibold content-center text-center text-sm">
                                    @if(empty($form->valueNames[$key]['en']))
                                        <span>{{ __("Value name #") . $key + 1 }}</span>
                                    @else
                                        <span>{{ $form->valueNames[$key]['en'] }}</span>
                                    @endif
                                </div>
                            </div>
                            <div x-show="expandedIndex === {{$key}}" class="flex flex-col gap-3">
                                @foreach(\App\Enums\Languages::cases() as $language)
                                    <div class="flex flex-col w-full">
                                        <x-input-label>{{ __('Value name ') . "({$language->isoCode()})" }}</x-input-label>
                                        <x-text-input
                                                wire:model.live="form.valueNames.{{ $key }}.{{ $language->isoCode() }}"/>
                                        <x-input-error
                                                :messages="$errors->get('form.valueNames.'. $key . $language->isoCode())"/>
                                    </div>
                                @endforeach
                                <div class="flex">
                                    <x-primary-button wire:click="translateValueNames({{ $key }})">
                                        {{ __('Translate') }}
                                    </x-primary-button>
                                    <div class="flex justify-center items-center ml-3 gap-2" wire:loading wire:target="translateValueNames">
                                        <i class="fa-solid fa-spinner animate-spin"></i> {{ __('Translation...') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="mt-5">
                        <x-secondary-button @click="expandedIndex = {{ count($this->form->valueNames) }}"
                                            wire:click="addParameterValue">
                            {{ __('Add value') }}
                        </x-secondary-button>
                    </div>
                </div>
            </div>
        </div>
        <div class="inline-flex flex-row-reverse mt-5 gap-5">
            <x-secondary-button>{{ __('Cancel') }}</x-secondary-button>
            <x-primary-button type="submit">{{ __('Save') }}</x-primary-button>
        </div>
    </form>
</div>