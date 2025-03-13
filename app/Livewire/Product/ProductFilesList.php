<?php

namespace App\Livewire\Product;

use App\Jobs\ProcessProductFileJob;
use App\Models\ProductFile;
use App\Services\ProductServices\ProductFileService;
use Illuminate\View\View;
use Livewire\Attributes\On;
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

    public function delete(ProductFile $productFile): void
    {
        $service = app(ProductFileService::class);
        $service->deleteFile($productFile);
    }

    public function processFile(ProductFile $productFile): void
    {
        $productFile->is_processing = true;
        $productFile->save();

        ProcessProductFileJob::dispatch($productFile);

        $this->dispatch('refresh');
    }

    #[On('add-new-file')]
    public function refresh(): void
    {
        $this->dispatch('refresh');
    }
}