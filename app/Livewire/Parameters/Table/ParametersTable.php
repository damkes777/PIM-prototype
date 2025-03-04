<?php

namespace App\Livewire\Parameters\Table;

use App\Models\Parameter;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\On;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class ParametersTable extends DataTableComponent
{
    protected $model = Parameter::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setConfigurableArea('toolbar-left-end', 'livewire.parameters.table.create-button');
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
            Column::make(__('Values'), 'id')
                  ->view('livewire.parameters.table.values'),
            Column::make(__('Actions'), 'id')
                  ->view('livewire.parameters.table.actions'),
        ];
    }

    public function openParameterNamesModal(int $parameterId): void
    {
        $this->dispatch('openModal', component: 'modals.parameters.parameter-names-modal', arguments: [
            'parameterId' => $parameterId,
        ]);
    }

    public function openParameterValuesModal(int $parameterId): void
    {
        $this->dispatch('openModal', component: 'modals.parameters.parameter-values-modal', arguments: [
            'parameterId' => $parameterId,
        ]);
    }

    public function createParameter(): void
    {
        $this->redirectRoute('parameters.create');
    }

    public function edit(int $parameterId): void
    {
        $this->redirectRoute('parameters.edit', ['id' => $parameterId]);
    }

    public function delete(int $parameterId): void
    {
        $parameter = Parameter::query()
                              ->with('values')
                              ->find($parameterId);

        if ($parameter->values()
                      ->exists()) {
            $this->dispatch('openModal', component: 'modals.parameters.parameter-delete-modal',
                arguments: ['parameterId' => $parameterId]);
        } else {
            $parameter->delete();
        }
    }

    #[On('delete-parameter')]
    public function deleteParameter(int $parameterId): void
    {
        Parameter::query()
                 ->find($parameterId)
                 ->delete();
    }
}