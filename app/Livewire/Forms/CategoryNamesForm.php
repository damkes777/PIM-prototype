<?php

namespace App\Livewire\Forms;

use App\Enums\Languages;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CategoryNamesForm extends Form
{
    public Category $category;

    #[Validate([
        'names' => 'required|array',
        'names.en' => 'required|string',
    ])]
    public $names = [];

    public function setData(): void
    {
        $categoryNames = $this->category->names;
        foreach (Languages::cases() as $language) {
            $name                              =
                $categoryNames->firstWhere('language', $language->isoCode())->name ?? null;
            $this->names[$language->isoCode()] = $name;
        }
    }

    public function create(): void
    {
        $this->validate();

        DB::transaction(function () {
            foreach ($this->names as $language => $name) {
                if (empty($name)) {
                    continue;
                }

                $this->category->names()
                               ->updateOrCreate(['language' => $language], ['name' => $name]);
            }
        });
    }
}