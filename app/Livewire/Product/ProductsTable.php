<?php

namespace App\Livewire\Product;

use App\Models\Product;
use App\Services\CategoryService;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class ProductsTable extends DataTableComponent
{
    protected $model = Product::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make(__('ID'), 'id')
                  ->sortable(),
            Column::make(__('Primary name (en)'))
                  ->label(fn($row, Column $column) => $row->english_name)
                  ->searchable(fn(Builder $query, $searchTrem) => $query->whereHas('names',
                      function (Builder $innerQuery) use ($searchTrem) {
                          $innerQuery->where('language', '=', 'en')
                                     ->where('name', 'like', "%$searchTrem%");
                      })),
            Column::make(__('Brand'), 'brand'),
            Column::make(__('Price'))
                  ->label(fn($row, Column $column) => $row->prices()
                                                          ->where('currency', '=', 'usd')
                                                          ->first()->price)
                  ->sortable(),
            Column::make(__('Currency'))
                  ->label(fn($row, Column $column) => $row->prices()
                                                          ->where('currency', '=', 'usd')
                                                          ->first()->currency),
            Column::make(__('Quantity'), 'quantity')
                  ->sortable(),
            Column::make(__('SKU'), 'sku'),
            Column::make(__('EAN'), 'ean'),
            Column::make(__('Names'))
                  ->label(fn($row, Column $column) => view('livewire.product.table.names')->withRow($row)),
            Column::make(__('Actions'))
                  ->label(fn($row, Column $column) => view('livewire.product.table.actions')->withRow($row)),
            Column::make('Category', 'category_id')
                  ->view('livewire.product.table.category')
                  ->collapseAlways(),
            Column::make('Parameters', 'parameters')
                  ->view('livewire.product.table.parameters')
                  ->collapseAlways(),
        ];
    }

    public function edit(int $productId): void
    {
        $this->redirectRoute('products.edit', ['id' => $productId]);
    }

    public function delete(int $productId): void
    {
        $product = Product::query()
                          ->find($productId);
        $product->delete();
    }

    public function hasCategory(Product $product): bool
    {
        return $product->category()
                       ->exists();
    }

    public function hasParameters(Product $product): bool
    {
        if ($product->parameters === null) {
            return false;
        }

        $parameters = unserialize($product->parameters);

        return !empty($parameters);
    }

    public function assignCategory(int $id): void
    {
        $this->redirectRoute('products.assignCategory', ['id' => $id]);
    }

    public function assignParameters(int $id): void
    {
        $this->redirectRoute('products.assignParameters', ['id' => $id]);
    }

    public function getCategoryPath(int $categoryId): string
    {
        $service = app(CategoryService::class);

        return $service->getPath($categoryId);
    }
}