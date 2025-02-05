<?php

namespace App\Livewire\Modals;

use App\Livewire\Forms\CategoryForm;
use App\Services\CategoryService;
use Illuminate\View\View;
use LivewireUI\Modal\ModalComponent;

class CreateCategoryModal extends AbstractCategoryFormModal
{
    public function save(CategoryService $service): void
    {
        $category = $this->form->createCategory($service);

        if ($category->exists) {
            $this->dispatch('closeModal');
            $this->dispatch('category-create');
        }
    }
}