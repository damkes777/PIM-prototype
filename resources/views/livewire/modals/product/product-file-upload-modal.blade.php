<x-wire-modal>
    <x-slot:title>
        {{ __("Upload file") }}
    </x-slot:title>
    <div class="w-full">
        <div class="w-full">
            <livewire:dropzone
                    wire:model="file"
                    :rules="['file','mimes:xml','max:10420']"
                    :multiple="false" />
        </div>
        <div class="mt-5">
            <x-primary-button wire:click="submit">{{ __('Submit') }}</x-primary-button>
        </div>
    </div>

</x-wire-modal>