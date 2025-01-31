<?php

namespace App\Livewire\Categories\Table;

use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\LivewireComponentColumn;

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
            Column::make(__('ID'), 'id')
                  ->sortable(),
            Column::make(__('Name'))
                  ->label(fn($row, Column $column) => $row->english_name)
                  ->searchable(fn(Builder $query, $searchTrem) => $query->whereHas('names',
                      function (Builder $innerQuery) use ($searchTrem) {
                          $innerQuery->where('language', '=', 'en')
                                     ->where('name', 'like', "%$searchTrem%");
                      })),
            Column::make(__('Parent'))
                  ->label(fn($row, Column $column) => $this->getCategoryParent($row->id)),
            LivewireComponentColumn::make(__('Actions'), 'id')
                                   ->component('categories.table.categories-table-actions'),
        ];
    }

    private function getCategoryParent(int $id): string
    {
        $service = new CategoryService();
        $parent  = $service->getParent($id);

        return $parent ? $parent->english_name : __('N/A');
    }

    private function getCategoryPath(int $id): string
    {
        return '';
    }
}
