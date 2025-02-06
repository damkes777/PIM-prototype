<?php

namespace App\Livewire\Modals;

class CategoryDeleteModal extends WarningModal
{
    public $categoryId;

    public function submit(): void
    {
        $this->dispatch($this->event, id: $this->categoryId);
        $this->dispatch('closeModal');
    }
}