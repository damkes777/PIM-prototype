<?php

namespace App\Livewire\Categories;

use App\Models\Category;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class CategoriesTable extends DataTableComponent
{
    protected $model = Category::class;
    protected $listeners = ['category-create' => 'refresh'];

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setConfigurableArea('toolbar-left-end', 'livewire.category.table.create-button');
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
        ];
    }
}