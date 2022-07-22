<?php

namespace App\Traits;

use App\Models\Permission;
use App\Models\Role;

trait HasPermissions
{
    public static function getRolePermissions(): array
    {
        return [
            Permission::KEY_ACCESS => Role::getAllRoles(),
            Permission::KEY_UPDATE => [Role::ROLE_ADMIN],
            Permission::KEY_DELETE => [Role::ROLE_ADMIN],
        ];
    }
}
