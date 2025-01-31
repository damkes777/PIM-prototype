<?php

namespace App\Livewire\Categories\Table;

use Illuminate\View\View;
use Livewire\Component;
use App\Models\Category;

class CategoriesTableActions extends Component
{
    public Category $category;

    public function render(): View
    {
        return view('livewire.category.table.actions');
    }
}