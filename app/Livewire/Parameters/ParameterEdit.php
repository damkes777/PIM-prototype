<?php

namespace App\Livewire\Parameters;

use App\Models\Parameter;

class ParameterEdit extends ParameterFormComponent
{
    public function mount(int $parameterId): void
    {
        $this->form->parameter = Parameter::query()
                                          ->with(['names', 'values.names'])
                                          ->find($parameterId);
        $this->form->setParameter();
    }

    public function save(): void
    {
        // TODO: Implement save() method.
    }
}