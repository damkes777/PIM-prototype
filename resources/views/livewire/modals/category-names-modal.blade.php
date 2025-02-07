<x-wire-modal>
    <div class="w-full" x-data="{ edit: false }">
        <x-slot:title>
            {{ __('Category names') }}
        </x-slot:title>
        <div class="flex flex-col w-full gap-3">
            @foreach(\App\Enums\Languages::cases() as $language)
                <div class="inline-flex flex-col px-5">
                    <x-input-label>{{ $language->isoName() }}</x-input-label>
                    <template x-if="edit">
                        <x-text-input value="{{ $this->getCategoryName($language->isoCode()) }}"/>
                    </template>
                    <template x-if="!edit">
                        <x-text-input value="{{ $this->getCategoryName($language->isoCode()) }}" disabled/>
                    </template>
                </div>
            @endforeach
            <div class="px-5">
                <x-primary-button @click="edit =! edit">{{ __('Edit') }}</x-primary-button>
                <x-secondary-button x-show="edit">{{ __('Translate') }}</x-secondary-button>
            </div>
        </div>
        <div class="flex flex-row-reverse gap-2 pt-5">
            <x-secondary-button x-show="edit">
                {{ __('Cancel') }}
            </x-secondary-button>
            <x-primary-button x-show="edit">
                {{ __('Save') }}
            </x-primary-button>
        </div>
    </div>
</x-wire-modal>