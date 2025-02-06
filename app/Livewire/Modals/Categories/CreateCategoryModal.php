<?php

namespace App\Livewire\Modals\Categories;

use App\Services\CategoryService;

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