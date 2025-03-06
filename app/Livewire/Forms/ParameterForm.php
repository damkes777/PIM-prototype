<?php

namespace App\Livewire\Forms;

use App\Models\Parameter;
use App\Services\ParameterService;
use App\Services\ParameterValuesService;
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

    #[Validate(['nullable'])]
    public $parameterValues = [];

    public function setParameter(): void
    {
        $names = $this->parameter->names;
        foreach ($names as $name) {
            $this->parameterNames[$name->language] = $name->name ?? '';
        }

        $values = $this->parameter->values;
        foreach ($values as $value) {
            $valueNames = [];
            foreach ($value->names as $name) {
                $valueNames[$name->language] = $name->name ?? '';
            }

            $this->parameterValues[] = [
                'id' => $value->id,
                'to_delete' => false,
                'names' => $valueNames,
            ];
        }
    }

    public function create(): void
    {
        $this->validate();

        try {
            DB::transaction(function () {
                $parameterService = app(ParameterService::class);
                $parameter        = $parameterService->createWithNames($this->parameterNames);

                if (!empty($this->parameterValues)) {
                    $parameterValuesService = app(ParameterValuesService::class);
                    $values                 =
                        $parameterValuesService->createWithNames($parameter->id, $this->parameterValues);
                }
            });
        } catch (Throwable $exception) {
            dd($exception->getMessage());
        }
    }

    public function update(): void
    {
        $this->validate();
    }
}