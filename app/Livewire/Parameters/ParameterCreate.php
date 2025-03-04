<?php

namespace App\Livewire\Parameters;

use App\Enums\Languages;

class ParameterCreate extends ParameterFormComponent
{
    public function mount(): void
    {
        foreach (Languages::cases() as $language) {
            $this->form->parameterNames[$language->isoCode()] = '';
            $this->form->valueNames[0][$language->isoCode()]  = '';
        }
    }

    public function save(): void
    {
        $this->form->create();
        $this->redirectRoute('parameters.list');
    }
}