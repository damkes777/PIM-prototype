<?php

namespace App\Livewire\Modals\Parameters;

use App\Livewire\Modals\WarningModal;

class ParameterDeleteModal extends WarningModal
{
    public string $title = 'Delete parameter';
    public string $content = 'You are trying to remove a parameter that has values. Deleting it will delete all its values.';
    public string $event = 'delete-parameter';

    public $parameterId;

    public function submit(): void
    {
        $this->dispatch($this->event, parameterId: $this->parameterId);
        $this->dispatch('closeModal');
    }
}