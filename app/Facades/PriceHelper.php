<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class PriceHelper extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return '';
    }

    public static function castToInt(string|float $price): int
    {
        return (int) str_replace(',', '', str_replace('.', '', $price));
    }

    public static function castToString(int $price): string
    {
        return number_format($price / 100, 2, ',', '');
    }
}
