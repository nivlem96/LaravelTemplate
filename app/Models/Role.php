<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property string $title
 *
 * @property-read Collection|Permission[] $permissions
 */
class Role extends Model
{
    const ROLE_ADMIN = 'admin';
    const ROLE_USER = 'user';

    private static array $_roles = [
        self::ROLE_ADMIN,
        self::ROLE_USER,
    ];

    public static function getAllRoles(): array
    {
        return self::$_roles;
    }

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'role_permissions');
    }
}
