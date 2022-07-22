<?php

namespace App\Helpers;

class ValutaHelper
{
    public static function getValutaStringFromFloat(float $float): string
    {
        return LocaleHelper::getValutaIcon() . ' ' . number_format($float, 2);
    }
}
