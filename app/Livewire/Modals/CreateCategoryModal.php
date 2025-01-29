<?php

namespace App\Livewire\Modals;

use App\Livewire\Forms\CategoryForm;
use App\Services\CategoryService;
use Illuminate\View\View;
use LivewireUI\Modal\ModalComponent;

class CreateCategoryModal extends ModalComponent
{
    public CategoryForm $form;

    public function render(): View
    {
        return view('livewire.modals.create-category');
    }

    public function createCategory(CategoryService $service): void
    {
        $category = $this->form->store($service);

        if ($category->exists) {
            $this->dispatch('closeModal');
            $this->dispatch('category-create');
        }
    }
}