<?php

namespace App\Livewire\Forms;

use App\Models\Parameter;
use App\Models\ParameterValue;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Throwable;

class ParameterForm extends Form
{
    public ?Parameter $parameter;

    #[Validate([
        'parameterNames' => 'array|required',
        'parameterNames.en' => 'required',
        'parameterNames.*' => 'nullable|string',
    ])]
    public $parameterNames = [];

    #[Validate(['array|nullable'])]
    public $parameterValues = [
        [
            "id" => null,
            "to_delete" => false,
            'names' => [
                "en" => "sda",
                "de" => "sad",
                "pl" => "",
                "ru" => "",
            ],
        ],
    ];

    public function setParameter(): void
    {
        $names = $this->parameter->names;
        foreach ($names as $name) {
            $this->parameterNames[$name->language] = $name->name;
        }
    }

    public function create(): void
    {
        $this->validate();

        try {
            $parameter = $this->createParameterWithNames();
        } catch (Throwable $exception) {
            dd($exception->getMessage());
        }
    }

    public function update(): void
    {
        $this->validate();
    }

    /**
     * @throws Throwable
     */
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
}