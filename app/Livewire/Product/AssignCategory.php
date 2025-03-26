<?php

namespace App\Livewire\Product;

use App\Models\Category;
use App\Models\Product;
use App\Services\CategoryService;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class AssignCategory extends Component
{
    use WithPagination, WithoutUrlPagination;

    public Product $product;
    public $search = '';

    #[Validate('required|integer')]
    public $selectedCategory = null;

    public function mount(): void
    {
        if ($this->product->category()->exists()) {
            $this->selectedCategory = $this->product->category_id;
        }
    }

    public function render(): View
    {
        return view('livewire.product.assign-category', ['categories' => $this->getCategories()]);
    }

    public function save(): void
    {
        $this->validate();

        $this->product->category()->associate($this->selectedCategory);
        $this->product->save();

        $this->redirectRoute('products.list');
    }

    public function cancel(): void
    {
        $this->redirectRoute('products.list');
    }

    public function getCategoryPath(int $id): string
    {
        $service = app(CategoryService::class);

        return $service->getPath($id);
    }

    public function getSelectedCategoryName(): string
    {
        $service = app(CategoryService::class);
        $category = $service->findCategory($this->selectedCategory);

        return $category->english_name;
    }

    protected function getCategories(): LengthAwarePaginator
    {
        return Category::query()
                       ->whereHas('names', function ($query) {
                           $query->where('name', 'like', '%' . $this->search . '%');
                       })
                       ->paginate(5);
    }
}