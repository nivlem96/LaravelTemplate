<?php

namespace App\Helpers;

class LanguageHelper
{
    private static array $_supportedLanguages = [
        'nl',
        'en',
    ];

    static function getSupportedLanguages(): array
    {
        return self::$_supportedLanguages;
    }
}
