<?php

namespace App\Livewire\Categories\Table;

use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Database\Eloquent\Builder;
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
            Column::make(__('Path'))
                  ->label(fn($row, Column $column) => $this->getCategoryPath($row->id)),
            Column::make(__('Actions'), 'id')
                  ->view('livewire.category.table.actions'),
        ];
    }

    private function getCategoryPath(int $id): string
    {
        $service  = app(CategoryService::class);
        $category = $service->findCategory($id);
        $path     = $category->english_name;

        while ($category->parent_id !== null) {
            $category = $service->findCategory($category->parent_id);
            $path     = $category->english_name . '/' . $path;
        }

        return $path;
    }

    private function getCategoryParent(int $id): string
    {
        $service = app(CategoryService::class);
        $parent  = $service->getParent($id);

        return $parent ? $parent->english_name : __('N/A');
    }

    public function createChildren(int $parentId): void
    {
        $this->dispatch('openModal', component: 'modals.create-category-child-modal', arguments: [
            'parentId' => $parentId,
        ]);
    }

    public function edit(int $id): void
    {

    }

    public function delete(int $edit): void
    {

    }
}
