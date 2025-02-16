<?php

namespace App\Livewire\Parameters;

use App\Enums\Languages;
use App\Livewire\Forms\ParameterForm;
use Illuminate\View\View;
use Livewire\Component;

class ParameterCreate extends Component
{
    public ParameterForm $form;

    public function render(): View
    {
        return view('livewire.parameters.create');
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
}