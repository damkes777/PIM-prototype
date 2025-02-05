<?php

namespace App\Livewire\Forms;

use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Support\Facades\App;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CategoryForm extends Form
{
    public ?Category $category;

    #[Validate('required|string|min:2')]
    public $name;

    public function createCategory(CategoryService $service): Category
    {
        $this->validate();

        $names = [
            ['language' => 'en', 'name' => $this->name],
        ];

        return $service->create($names);
    }

    public function createChildren(CategoryService $service): Category
    {
        $this->validate();

        $names = [
            ['language' => 'en', 'name' => $this->name],
        ];

        return $service->createChild($this->category, $names);
    }
}