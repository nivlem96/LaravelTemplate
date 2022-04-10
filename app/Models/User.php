<?php

namespace App\Models;

use App\Helpers\PermissionHelper;
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
 * @property-read Collection|Permission[] $userPermissions
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

    public function can($abilities, $arguments = []): bool
    {
        $data = PermissionHelper::getModelAndKeyFromAbility($abilities);
        $model = $data['model'];
        $key = $data['key'];

        if ($model === null || $key === null) {
            return false;
        }

        return $this->permissions()
                    ->where('model', ucfirst(strtolower($model)))
                    ->where('key', strtolower($key))
                    ->exists();
    }

    public function permissions(): BelongsToMany
    {
        $rolePermissions = $this->role->permissions();
        $userPermissions = $this->userPermissions()->whereNotIn('id', $rolePermissions->pluck('id'));

        return $rolePermissions->union($userPermissions);
    }

    public function userPermissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'user_permissions');
    }
}
