<x-wire-modal>
    <x-slot:title>
        {{ __('Create category') }}
    </x-slot:title>
    <div class="inline-flex flex-col w-64 mx-auto">
        <x-input-label for="name" :value="__('Name')" />
        <x-text-input wire:model="form.name" id="name" name="name" type="text" class="mt-1 block w-full" required/>
        <x-input-error class="mt-2" :messages="$errors->get('form.name')" />
    </div>
    <x-slot:buttons>
        <x-secondary-button wire:click="dispatch('closeModal')">
            {{ __('Cancel') }}
        </x-secondary-button>
        <x-primary-button wire:click="createCategory">
            {{ __('Save') }}
        </x-primary-button>
    </x-slot:buttons>
</x-wire-modal>