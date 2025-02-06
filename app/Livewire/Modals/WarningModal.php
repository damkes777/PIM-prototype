<?php

namespace App\Livewire\Modals;

use Illuminate\View\View;
use LivewireUI\Modal\ModalComponent;

abstract class WarningModal extends ModalComponent
{
    public string $title;
    public string $content;
    public string $event;

    public function render(): View
    {
        return view('livewire.modals.warning-modal');
    }

    public abstract function submit(): void;
}