<?php

namespace App\Livewire\Product;

use App\Models\Parameter;
use App\Models\ParameterValue;
use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Component;

class AssignParameters extends Component
{
    public Product $product;

    public $selectedParameters = [];
    public $selectedParameterValues = [];
    public $search = '';

    public function mount(): void
    {
        $parameters = unserialize($this->product->parameters);
        if ($parameters) {
            $this->selectedParameters      = $this->setSelectedParameters($parameters);
            $this->selectedParameterValues = $this->setSelectedParameterValues($parameters);
        }
    }

    public function render(): View
    {
        return view('livewire.product.assign-parameters', ['parameters' => $this->getParameters()]);
    }

    public function save(): void
    {
        $data                      = $this->prepareParametersData();
        $this->product->parameters = serialize($data);
        $this->product->save();

        $this->redirectRoute('products.list');
    }

    public function cancel(): void
    {
        $this->redirectRoute('products.list');
    }

    public function getParameterName(int $parameterId): string
    {
        return Parameter::query()
                        ->find($parameterId)->english_name;
    }

    public function getParameterValues(int $parameterId): Collection
    {
        return ParameterValue::query()
                             ->with('names')
                             ->where('parameter_id', $parameterId)
                             ->get();
    }

    protected function getParameters(): LengthAwarePaginator
    {
        return Parameter::query()
                        ->whereHas('names', function ($query) {
                            $query->where('name', 'like', '%' . $this->search . '%');
                        })
                        ->paginate(5);
    }

    protected function prepareParametersData(): array
    {
        $data = [];
        foreach ($this->selectedParameterValues as $parameterId => $parameterValue) {
            $data[$parameterId] = collect($parameterValue)
                ->filter(function ($value) {
                    return $value === true;
                })
                ->keys()
                ->toArray();
        }

        return $data;
    }

    protected function setSelectedParameters(array $parameters): array
    {
        if (empty($parameters)) {
            return [];
        }
        return array_keys($parameters);
    }

    protected function setSelectedParameterValues(array $parameters): array
    {
        if (empty($parameters)) {
            return [];
        }

        $parameterValues = [];
        foreach ($parameters as $parameterId => $parameterValue) {
            foreach ($parameterValue as $value) {
                $parameterValues[$parameterId][$value] = true;
            }
        }

        return $parameterValues;
    }
}