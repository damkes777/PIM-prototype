<?php

namespace App\Livewire\Modals\ParameterValues;

use App\Enums\Languages;
use Illuminate\View\View;
use Livewire\Attributes\Validate;
use LivewireUI\Modal\ModalComponent;

class ParameterValueFormModal extends ModalComponent
{
    #[Validate([
        'valueNames' => 'array|required',
        'valueNames.en' => 'required',
        'valueNames.*' => 'nullable|string',
    ])]
    public $valueNames = [];

    public null|int $arrayKey = null;

    public function mount(
        null|int $arrayKey = null,
        null|array $names = null): void
    {
        $this->arrayKey = $arrayKey;
        if (empty($names)) {
            $this->valueNames = array_fill_keys(array_map(fn($lang) => $lang->isoCode(), Languages::cases()), '');
        } else {
            $this->valueNames = $names;
        }
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
        $this->dispatch('add-parameter-value', valueNames: $this->valueNames, key: $this->arrayKey);
        $this->dispatch('closeModal');
    }
}