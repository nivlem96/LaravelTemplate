<?php

namespace App\Models;

use App\Traits\HasPermissions;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $code
 * @property string $message
 * @property string $file
 * @property string $line
 * @property array $trace
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Log extends Model
{
    use HasPermissions {
        getRolePermissions as public traitRolePermissions;
    }

    protected $casts = [
        'trace' => 'array',
    ];

    public static function getRolePermissions(): array
    {
        return array_merge(self::traitRolePermissions(),
            [
                Permission::KEY_ACCESS => [Role::ROLE_ADMIN],
            ]
        );
    }
}
