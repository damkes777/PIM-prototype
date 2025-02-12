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
                        <x-text-input wire:model="form.names.{{$language->isoCode()}}"/>
                    </template>
                    <template x-if="!edit">
                        <x-text-input wire:model="form.names.{{$language->isoCode()}}" disabled/>
                    </template>
                    <x-input-error class="mt-2" :messages="$errors->get('form.names' . $language->isoCode())"/>
                </div>
            @endforeach

            <div class="flex gap-3 px-5">
                <x-primary-button @click="edit =! edit">{{ __('Edit') }}</x-primary-button>
                <x-secondary-button x-show="edit" wire:click="translate">{{ __('Translate') }}</x-secondary-button>
            </div>
            <div wire:loading class="flex justify-center items-center ml-3 gap-2">
                <i class="fa-solid fa-spinner animate-spin"></i> {{ __('Translation...') }}
            </div>
        </div>
        <div class="flex flex-row-reverse gap-2 pt-5">
            <x-secondary-button x-show="edit" wire:click="dispatch('closeModal')">
                {{ __('Cancel') }}
            </x-secondary-button>
            <x-primary-button wire:click="save" x-show="edit">
                {{ __('Save') }}
            </x-primary-button>
        </div>
    </div>
</x-wire-modal>