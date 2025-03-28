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

    public function render(): View
    {
        return view('livewire.product.assign-parameters', ['parameters' => $this->getParameters()]);
    }

    public function save(): void
    {
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
}