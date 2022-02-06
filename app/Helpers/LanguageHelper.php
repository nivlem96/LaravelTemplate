<?php

namespace App\Helpers;

class LanguageHelper
{
    private static $_supportedLanguages =[
        'nl',
        'en',
    ];

    static function getSupportedLanguages(){
        return self::$_supportedLanguages;
    }
}
