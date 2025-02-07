<?php

namespace App\Livewire\Modals\CategoryNames;

use App\Services\CategoryNamesService;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use LivewireUI\Modal\ModalComponent;

class CategoryNamesModal extends ModalComponent
{
    public int $categoryId;

    public function render(): View
    {
        return view('livewire.modals.category-names-modal');
    }

    public function getCategoryName(string $languageIsoCode): string|null
    {
        $name = $this->names->firstWhere('language', $languageIsoCode);

        return $name->name ?? null;
    }

    #[Computed]
    public function names(): Collection
    {
        $service = app(CategoryNamesService::class);

        return $service->getNames($this->categoryId);
    }
}