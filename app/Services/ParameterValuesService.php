<?php

namespace App\Services;

use App\Models\ParameterValue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Throwable;

class ParameterValuesService
{
    public function find(int $id): ParameterValue
    {
        return ParameterValue::query()
                             ->findOrFail($id);
    }

    /**
     * @throws Throwable
     */
    public function createWithNames(int $parameterId, array $values): Collection
    {
        return DB::transaction(function () use ($parameterId, $values) {
            $parameterValues = collect();
            foreach ($values as $value) {
                $parameterValue = $this->createValue($parameterId);
                $parameterValue = $this->createValueNames($parameterValue, $value['names']);
                $parameterValues->push($parameterValue);
            }

            return $parameterValues;
        });
    }

    /**
     * @throws Throwable
     */
    public function updateOrCreateValuesWithNames(int $parameterId, array $values): Collection
    {
        return DB::transaction(function () use ($parameterId, $values) {
            $parameterValues = collect();
            foreach ($values as $value) {
                if ($value['id'] === null) {
                    $parameterValue = $this->createValue($parameterId);
                    $this->createValueNames($parameterValue, $value['names']);
                } else {
                    $parameterValue = $this->updateValueNames($value['id'], $value['names']);
                }
                $parameterValues->push($parameterValue);
            }

            return $parameterValues;
        });
    }

    protected function createValue(int $parameterId): ParameterValue
    {
        return ParameterValue::query()
                             ->create([
                                 'parameter_id' => $parameterId,
                             ]);
    }

    protected function createValueNames(ParameterValue $parameterValue, array $names): Collection
    {
        $valueNames = collect($names)->map(fn($name, $language) => ['name' => $name, 'language' => $language]);

        return $parameterValue->names()
                              ->createMany($valueNames);
    }

    protected function updateValueNames(int $parameterValueId, array $names): ParameterValue
    {
        $parameterValue = $this->find($parameterValueId)
                               ->loadMissing('names');

        foreach ($names as $lang => $name) {
            $parameterValue->names()
                           ->where('language', $lang)
                           ->update(['name' => $name]);
        }

        return $parameterValue;
    }
}