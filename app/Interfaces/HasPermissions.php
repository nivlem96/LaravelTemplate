<?php

namespace App\Interfaces;

interface HasPermissions
{
    public static function getRolePermissions(): array;
}
