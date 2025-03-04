<?php

namespace App\Livewire\Parameters;

use App\Enums\Languages;
use App\Livewire\Forms\ParameterForm;
use App\Services\TranslateServices\TranslateService;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

abstract class ParameterFormComponent extends Component
{
    public ParameterForm $form;

    public abstract function save(): void;

    public function render(): View
    {
        return view('livewire.parameters.form');
    }

    public function isEnglishLanguage(string $isoCode): bool
    {
        $english = Languages::ENGLISH;

        return $english->isoCode() === $isoCode;
    }

    public function addParameterValue(): void
    {
        $this->dispatch('openModal', component: 'modals.parameter-values.parameter-value-create-modal');
    }

    /**
     * @throws GuzzleException
     */
    public function translateParameterNames(TranslateService $service): void
    {
        foreach (array_keys($this->form->parameterNames) as $language) {
            if ($language !== 'en') {
                $englishName                           = $this->form->parameterNames['en'];
                $this->form->parameterNames[$language] = $service->translate($englishName, $language);
            }
        }
    }

    public function getIsoName(string $lang): string
    {
        return Languages::getFromIsoCode($lang)->isoName();
    }

    #[On('add-parameter-value')]
    public function handleParameterValue(array $valueNames): void
    {
        $value = [
            'id' => null,
            'to_delete' => false,
            'names' => $valueNames['valueNames'],
        ];

        $this->form->parameterValues[] = $value;
    }
}