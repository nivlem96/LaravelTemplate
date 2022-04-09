<?php

namespace App\Models;

use App\Interfaces\HasPermissions;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 *
 * @property-read Role $role
 * @property-read Collection|Permission[] $permissions
 */
class User extends Authenticatable implements HasPermissions
{
    use HasApiTokens, HasFactory, Notifiable;

    const PASSWORD_MIN_LENGTH = 6;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function getRolePermissions(): array
    {
        return [
            Permission::KEY_ACCESS => Role::getAllRoles(),
            Permission::KEY_ACCESS_OTHER => [Role::ROLE_ADMIN],
            Permission::KEY_UPDATE => Role::getAllRoles(),
            Permission::KEY_UPDATE_OTHER => [Role::ROLE_ADMIN],
            Permission::KEY_DELETE => Role::getAllRoles(),
            Permission::KEY_DELETE_OTHER => [Role::ROLE_ADMIN],
        ];
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function getPermissions(): Collection
    {
        $rolePermissions = $this->role->permissions;
        $userPermissions = $this->permissions;
        $mergedPermissions = $rolePermissions->merge($userPermissions);

        return $mergedPermissions->unique();
    }

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'user_permissions');
    }
}
