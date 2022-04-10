<?php

namespace App\Helpers;

class ClassHelper
{
    public static function getClassName(object $class): string
    {
        $classString = get_class($class);
        $explodedClassName = explode('\\', $classString);

        return $explodedClassName[count($explodedClassName) - 1];
    }
}
