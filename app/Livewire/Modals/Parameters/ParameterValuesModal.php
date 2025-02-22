<?php

namespace App\Livewire\Modals\Parameters;

use App\Enums\Languages;
use App\Models\ParameterValue;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use LivewireUI\Modal\ModalComponent;

class ParameterValuesModal extends ModalComponent
{
    public Collection $values;

    public function mount(int $parameterId): void
    {
        $this->values = ParameterValue::query()
                                      ->with('names')
                                      ->where('parameter_id', $parameterId)
                                      ->get();
    }

    public function render(): View
    {
        return view('livewire.modals.parameter-values-modal');
    }

    public function getLanguage(string $langIsoCode): string
    {
        return Languages::getFromIsoCode($langIsoCode)
                        ->isoName();
    }
}