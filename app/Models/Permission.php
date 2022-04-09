<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $model
 * @property string $key
 */
class Permission extends Model
{
    const KEY_ACCESS = 'access';
    const KEY_ACCESS_OTHER = 'access_other';
    const KEY_UPDATE = 'update';
    const KEY_UPDATE_OTHER = 'update_other';
    const KEY_DELETE = 'delete';
    const KEY_DELETE_OTHER = 'delete_other';
}
