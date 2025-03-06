<x-wire-modal>
    <x-slot:title>
        {{ __('Parameter value') }}
    </x-slot:title>
    <div class="inline-flex flex-col w-64 gap-3 mx-auto">
        @foreach($this->valueNames as $language => $valueName)
            <div class="flex w-full flex-col">
                <x-input-label>{{ $this->getLabel($language) }}</x-input-label>
                <x-text-input wire:model="valueNames.{{ $language }}" name="valueNames.{{ $language }}"/>
                @error('valueNames.' . $language)
                    <x-input-error :messages="$message" class="mt-2" />
                @enderror
            </div>
        @endforeach
    </div>
    <x-slot:buttons>
        <x-secondary-button wire:click="dispatch('closeModal')">
            {{ __('Cancel') }}
        </x-secondary-button>
        <x-primary-button wire:click="add">
            {{ __('Submit') }}
        </x-primary-button>
    </x-slot:buttons>
</x-wire-modal>