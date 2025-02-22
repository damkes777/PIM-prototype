<?php

namespace App\Livewire\Forms;

use App\Enums\Languages;
use App\Models\Parameter;
use App\Models\ParameterValue;
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

        try {
          $this->createParameterWithNames();
          $this->createValuesWithNames();
        } catch (\Exception $exception) {
            dd($exception->getMessage());
        }
    }

    public function update()
    {

    }

    private function createParameterWithNames(): void
    {
        DB::transaction(function () {
            $parameter = Parameter::query()
                                  ->create();

            $names = [];
            foreach ($this->parameterNames as $language => $name) {
                $names[] = ['language' => $language, 'name' => $name];
            }

            $parameter->names()
                      ->createMany($names);
        });
    }

    private function createValuesWithNames(): void
    {
        DB::transaction(function () {
            foreach ($this->valueNames as $valueName) {
                $value = ParameterValue::query()->create();

                $names = [];
                foreach ($valueName as $language => $name) {
                    $names[] = ['language' => $language, 'name' => $name];
                }

                $value->names()->createMany($names);
            }
        });
    }
}