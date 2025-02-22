<?php

namespace App\Livewire\Forms;

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
            $parameter = $this->createParameterWithNames();
            $this->createValuesWithNames($parameter);
        } catch (\Exception $exception) {
            dd($exception->getMessage());
        }
    }

    public function update()
    {

    }

    private function createParameterWithNames(): Parameter
    {
        return DB::transaction(function () {
            $parameter = Parameter::query()
                                  ->create();

            $names = [];
            foreach ($this->parameterNames as $language => $name) {
                $names[] = ['language' => $language, 'name' => $name];
            }

            $parameter->names()
                      ->createMany($names);

            return $parameter;
        });
    }

    private function createValuesWithNames(Parameter $parameter): void
    {
        DB::transaction(function () use ($parameter) {
            foreach ($this->valueNames as $valueName) {
                $value = ParameterValue::query()
                                       ->create(['parameter_id' => $parameter->id]);

                $names = [];
                foreach ($valueName as $language => $name) {
                    $names[] = ['language' => $language, 'name' => $name];
                }

                $value->names()
                      ->createMany($names);
            }
        });
    }
}