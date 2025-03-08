<x-wire-modal>
    <x-slot:title>
        {{ __("Upload file") }}
    </x-slot:title>
    <div class="w-full">
        <livewire:dropzone
                wire:model="file"
                :rules="['file','mimes:xml','max:10420']"
                :multiple="false" />
    </div>
</x-wire-modal>