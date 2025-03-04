<?php

namespace App\Livewire\Modals\ParameterValues;

use App\Enums\Languages;
use Illuminate\View\View;
use Livewire\Attributes\Validate;
use LivewireUI\Modal\ModalComponent;

class ParameterValueCreateModal extends ModalComponent
{
    #[Validate([
        'valueNames' => 'array|required',
        'valueNames.en' => 'required',
        'valueNames.*' => 'nullable|string',
    ])]
    public $valueNames = [];

    public function mount(): void
    {
        $this->valueNames = array_fill_keys(array_map(fn($lang) => $lang->isoCode(), Languages::cases()), '');
    }

    public function render(): View
    {
        return view('livewire.modals.parameter-values.create');
    }

    public function getLabel(string $lang): string
    {
        return Languages::getFromIsoCode($lang)->isoName();
    }

    public function translate(): void
    {
        //
    }

    public function add(): void
    {
        $this->validate();
        $this->dispatch('add-parameter-value', ['valueNames' => $this->valueNames]);
        $this->dispatch('closeModal');
    }
}