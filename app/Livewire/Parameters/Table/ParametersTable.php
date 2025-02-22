<?php

namespace App\Livewire\Parameters\Table;

use App\Models\Parameter;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class ParametersTable extends DataTableComponent
{
    protected $model = Parameter::class;

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
                  ->searchable(fn(Builder $query, $searchTrem) => $query->whereHas('names', function (
                      Builder $innerQuery
                  ) use ($searchTrem) {
                      $innerQuery->where('language', '=', 'en')
                                 ->where('name', 'like', "%$searchTrem%");
                  })),
            Column::make(__('Names'), 'id')
                  ->view('livewire.parameters.table.names'),
        ];
    }

    public function openParameterNamesModal(int $parameterId): void
    {
        $this->dispatch('openModal', component: 'modals.parameters.parameter-names-modal', arguments: [
            'parameterId' => $parameterId,
        ]);
    }
}