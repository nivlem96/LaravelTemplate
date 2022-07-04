<?php

namespace App\Helpers;

class LocaleHelper
{
    private static array $_supportedLanguages = [
        'nl',
        'en',
    ];

    static function getSupportedLanguages(): array
    {
        return self::$_supportedLanguages;
    }

    public static function getValutaIcon(): string
    {
        return '&euro;';
    }
}
