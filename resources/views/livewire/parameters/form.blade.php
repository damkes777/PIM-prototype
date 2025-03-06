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
                        <x-primary-button wire:click="translateParameterNames">
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
                <div class="flex w-full justify-between items-center">
                    <h3 class="font-semibold">
                        {{ __('Parameter values') }}
                    </h3>
                    <x-secondary-button wire:click="addParameterValue">
                        {{ __('add value') }}
                    </x-secondary-button>
                </div>
            </div>
            <div class="flex flex-wrap gap-3 px-20">
                @if(empty($this->form->parameterValues))
                    <span class="text-zinc-400 italic">{{ __("no parameter values") }}</span>
                @endif
                @foreach($this->form->parameterValues as $key => $parameterValues)
                    <div class="w-[250px] p-2 border rounded-md text-sm">
                        <div class="flex justify-between">
                            <div class="flex items-center">
                                @if(empty($parameterValues['id']))
                                    <span class="font-semibold">{{ __('New') }}</span>
                                @else
                                    <span>{{ __('ID: ') . $parameterValues['id']}}</span>
                                @endif
                            </div>
                            <div class="flex gap-2">
                                <button wire:click="editParameterValue({{ $key }})"
                                        class="text-zinc-500/50 hover:text-zinc-800 p-1">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                                <button class="text-zinc-500/50 hover:text-zinc-800 p-1">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </div>
                        </div>
                        <div class="mt-2">
                            <ul>
                                @foreach($parameterValues['names'] as $lang => $name)
                                    <li class="break-words">
                                        <span class="font-semibold">{{ $this->getIsoName($lang) }}:</span>
                                        <span>{{ $name }}</span>
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="inline-flex flex-row-reverse mt-5 gap-5">
            <x-secondary-button>{{ __('Cancel') }}</x-secondary-button>
            <x-primary-button type="submit">{{ __('Save') }}</x-primary-button>
        </div>
    </form>
</div>