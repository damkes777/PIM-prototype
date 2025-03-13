<?php

namespace App\Livewire\Product;

use App\Models\ProductFile;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class ProductFilesList extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $query = '';

    public function queryUpdated(): void
    {
        $this->resetPage();
    }

    public function render(): View
    {
        return view('livewire.product.product-files-list', [
            'files' => ProductFile::query()
                                  ->where('name', 'like', '%' . $this->query . '%')
                                  ->paginate(3)]);
    }
}