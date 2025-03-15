<?php

namespace App\Livewire\Product;

use App\Models\Product;
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
                                                          ->first()->price),
            Column::make(__('Currency'))
                  ->label(fn($row, Column $column) => $row->prices()
                                                          ->where('currency', '=', 'usd')
                                                          ->first()->currency),
            Column::make(__('SKU'), 'sku'),
            Column::make(__('EAN'), 'ean'),
            Column::make(__('Names'))
                  ->label(fn($row, Column $column) => view('livewire.product.table.names')->withRow($row)),
            Column::make(__('Actions'))
                  ->label(fn($row, Column $column) => view('livewire.product.table.actions')->withRow($row)),
        ];
    }
}