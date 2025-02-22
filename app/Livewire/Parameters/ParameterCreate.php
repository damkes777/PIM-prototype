<?php

namespace App\Livewire\Parameters;

use App\Enums\Languages;
use App\Livewire\Forms\ParameterForm;
use App\Services\TranslateServices\TranslateService;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\View\View;
use Livewire\Component;

class ParameterCreate extends Component
{
    public ParameterForm $form;

    public function mount(): void
    {
        foreach (Languages::cases() as $language) {
            $this->form->parameterNames[$language->isoCode()] = '';
            $this->form->valueNames[0][$language->isoCode()]  = '';
        }
    }

    public function render(): View
    {
        return view('livewire.parameters.create');
    }

    public function save(): void
    {
        $this->form->create();
        $this->redirectRoute('parameters.list');
    }

    public function isEnglishLanguage(string $isoCode): bool
    {
        $english = Languages::ENGLISH;

        return $english->isoCode() === $isoCode;
    }

    public function addParameterValue(): void
    {
        $this->form->valueNames[] = [];
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

    /**
     * @throws GuzzleException
     */
    public function translateValueNames(int $key): void
    {
        $service = app(TranslateService::class);
        $values  = $this->form->valueNames[$key];

        foreach (array_keys($values) as $language) {
            if ($language !== 'en') {
                $englishName       = $values['en'];
                $values[$language] = $service->translate($englishName, $language);
            }
        }

        $this->form->valueNames[$key] = $values;
    }
}