<?php

namespace App\Livewire\Modals\CategoryNames;

use App\Livewire\Forms\CategoryNamesForm;
use App\Models\Category;
use App\Services\TranslateServices\TranslateService;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\View\View;
use LivewireUI\Modal\ModalComponent;

class CategoryNamesModal extends ModalComponent
{
    public CategoryNamesForm $form;

    public function mount(int $categoryId): void
    {
        $this->form->category = Category::with('names')
                                        ->find($categoryId);
        $this->form->setData();
    }

    public function render(): View
    {
        return view('livewire.modals.category-names-modal');
    }

    public function getCategoryName(string $languageIsoCode): string|null
    {
        $name = $this->names->firstWhere('language', $languageIsoCode);

        return $name->name ?? null;
    }

    public function save(): void
    {
        try {
            $this->form->create();
            $this->dispatch('closeModal');
        } catch (\Exception $exception) {

        }
    }

    /**
     * @throws GuzzleException
     */
    public function translate(TranslateService $service): void
    {
        foreach (array_keys($this->form->names) as $language) {
            if ($language !== 'en') {
                $englishName                  = $this->form->names['en'];
                $this->form->names[$language] = $service->translate($englishName, $language);
            }
        }
    }
}