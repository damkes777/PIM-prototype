<?php

namespace App\Livewire\Forms;

use App\Models\Parameter;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ParameterForm extends Form
{
    #[Validate([
        'parameterNames' => 'array|required',
        'parameterNames.en' => 'required',
        'parameterNames.*' => 'nullable|string',
    ])]
    public $parameterNames = [];

    #[Validate([
        'valueNames' => 'array|nullable',
    ])]
    public $valueNames = [[]];

    public function create(): void
    {
        $this->validate();
        dd($this->valueNames);

        try {
            DB::transaction(function () {
                $parameter = Parameter::query()
                                      ->create();
                $parameter->names()
                          ->create($this->parameterNames);
            });
        } catch (\Exception $exception) {

        }
    }

    public function update()
    {

    }
}