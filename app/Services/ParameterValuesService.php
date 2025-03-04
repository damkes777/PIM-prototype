<?php

namespace App\Services;

use App\Models\ParameterValue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Throwable;

class ParameterValuesService
{
    /**
     * @throws Throwable
     */
    public function createWithNames(int $parameterId, array $values): Collection
    {
        return DB::transaction(function () use ($parameterId, $values) {
            $parameterValues = collect();
            foreach ($values as $value) {
                $parameterValue = ParameterValue::query()->create(['parameter_id' => $parameterId]);
                $valueNames = collect($value['names'])->map(fn($name, $language) => ['name' => $name, 'language' => $language]);
                $parameterValue->names()->createMany($valueNames);
                $parameterValues->push($parameterValue);
            }

            return $parameterValues;
        });
    }
}