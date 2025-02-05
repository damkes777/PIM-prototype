<?php

namespace App\Livewire\Modals;

use App\Services\CategoryService;

class CreateCategoryChildModal extends AbstractCategoryFormModal
{
    public int $parentId;

    public function save(CategoryService $service): void
    {
        $this->form->category = $service->findCategory($this->parentId);
        $category             = $this->form->createChildren($service);

        if ($category->exists) {
            $this->dispatch('closeModal');
            $this->dispatch('category-create');
        }
    }
}