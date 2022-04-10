<?php

namespace App\Helpers;

class PermissionHelper
{
    public static function getModelAndKeyFromAbility($ability): array
    {
        $data = [
            'model' => null,
            'key' => null,
        ];
        if (is_array($ability)) {
            $data['model'] = $ability['model'] ?? $ability[0] ?? null;
            $data['key'] = $ability['key'] ?? $ability[1] ?? null;
        } elseif (is_string($ability)) {
            $explodedAbility = explode('.', $ability, 2);
            $data['model'] = $explodedAbility[0] ?? null;
            $data['key'] = $explodedAbility[1] ?? null;
        }

        return $data;
    }
}
