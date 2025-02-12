<?php

namespace App\Contracts;

interface Translatable
{
    public function translate(string $word, string $targetLanguage): string;
}