<?php

namespace App\Livewire\Forms;

use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Support\Facades\App;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CategoryForm extends Form
{
    #[Validate('required|string|min:2')]
    public $name;

    public function store(CategoryService $service): Category
    {
        $this->validate();

        $names = [
            ['language' => App::getLocale(), 'name' => $this->name],
        ];

        return $service->create($names);
    }
}