<?php

namespace App\Enums;

enum Languages
{
    case ENGLISH;
    case GERMANY;
    case POLISH;
    case RUSSIAN;

    public function isoName(): string
    {
        return match ($this) {
            self::ENGLISH => 'English',
            self::GERMANY => 'Germany',
            self::POLISH => 'Polish',
            self::RUSSIAN => 'Russian'
        };
    }

    public function isoCode(): string
    {
        return match ($this) {
            self::ENGLISH => 'en',
            self::GERMANY => 'de',
            self::POLISH => 'pl',
            self::RUSSIAN => 'ru'
        };
    }

    public static function getFromIsoCode(string $isoCode): ?self
    {
        return match ($isoCode) {
            'en' => self::ENGLISH,
            'de' => self::GERMANY,
            'pl' => self::POLISH,
            'ru' => self::RUSSIAN,
            default => null
        };
    }
}
