<?php

namespace App\Services;

use App\Models\Parameter;
use Illuminate\Support\Facades\DB;
use Throwable;

class ParameterService
{
    /**
     * @throws Throwable
     */
    public function createWithNames(array $names): Parameter
    {
        return DB::transaction(function () use ($names) {
            $parameter = Parameter::query()
                                  ->create();
            $namesData = collect($names)->map(fn($name, $language) => ['name' => $name, 'language' => $language]);
            $parameter->names()
                      ->createMany($namesData);

            return $parameter;
        });
    }
}