<?php

namespace App\Livewire\Modals\Categories;

use App\Livewire\Modals\WarningModal;

class CategoryDeleteModal extends WarningModal
{
    public string $title = 'Delete category';
    public string $content = 'You are trying to remove a category that has children. Deleting it will remove any child categories';
    public string $event = 'delete-category';

    public $categoryId;

    public function submit(): void
    {
        $this->dispatch($this->event, id: $this->categoryId);
        $this->dispatch('closeModal');
    }
}