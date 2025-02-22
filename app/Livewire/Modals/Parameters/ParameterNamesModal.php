<?php

namespace App\Livewire\Modals\Parameters;

use App\Enums\Languages;
use App\Models\ParameterName;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use LivewireUI\Modal\ModalComponent;

class ParameterNamesModal extends ModalComponent
{
    public Collection $names;

    public function mount(int $parameterId): void
    {
        $this->names = ParameterName::query()
                                    ->where('parameter_id', $parameterId)
                                    ->get();
    }

    public function render(): View
    {
        return view('livewire.modals.parameter-names-modal');
    }

    public function getLanguage(string $langIsoCode): string
    {
        return Languages::getFromIsoCode($langIsoCode)
                        ->isoName();
    }
}