<?php

namespace App\Livewire\Modals\Categories;

use App\Livewire\Forms\CategoryForm;
use App\Services\CategoryService;
use Illuminate\View\View;
use LivewireUI\Modal\ModalComponent;

abstract class AbstractCategoryFormModal extends ModalComponent
{
    public CategoryForm $form;

    public function render(): View
    {
        return view('livewire.modals.category-form-modal');
    }

    public abstract function save(CategoryService $service): void;
}