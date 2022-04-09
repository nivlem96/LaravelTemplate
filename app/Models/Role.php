<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $title
 */
class Role extends Model
{
    const ROLE_ADMIN = 'admin';
    const ROLE_USER = 'user';

    private static array $defaultRoles = [
        self::ROLE_ADMIN,
        self::ROLE_USER,
    ];

    public static function getDefaultRoles(): array
    {
        return self::$defaultRoles;
    }
}
