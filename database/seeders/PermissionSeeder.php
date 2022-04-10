<?php

namespace Database\Seeders;

use App\Helpers\ClassHelper;
use App\Interfaces\HasPermissions;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Container\Container;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cachedRoles = [];
        $appNamespace = Container::getInstance()->getNamespace();
        $modelNamespace = 'Models';

        $models = collect(File::allFiles(app_path($modelNamespace)))->map(function ($item) use ($appNamespace, $modelNamespace) {
            $rel = $item->getRelativePathName();
            $class = sprintf('\%s%s%s', $appNamespace, $modelNamespace ? $modelNamespace . '\\' : '',
                implode('\\', explode('/', substr($rel, 0, strrpos($rel, '.')))));

            return class_exists($class) ? $class : null;
        })->filter();
        foreach ($models as $modelClass) {
            $model = new $modelClass();
            if ($model instanceof HasPermissions) {
                $className = ClassHelper::getClassName($model);
                foreach ($model::getRolePermissions() as $key => $roles) {
                    $permission = Permission::query()->where('model', $className)->where('key', $key)->first();
                    if ($permission === null) {
                        $permission = new Permission();
                        $permission->model = $className;
                        $permission->key = $key;
                        $permission->save();
                        $permission->refresh();
                    }
                    foreach ($roles as $role) {
                        /** @var Role $cachedRole */
                        $cachedRole = $cachedRoles[$role] ?? null;
                        if ($cachedRole === null) {
                            $cachedRole = $cachedRoles[$role] = Role::query()->where('title', $role)->first();
                        }

                        if ($cachedRole->permissions()->find($permission->id) === null) {
                            $cachedRole->permissions()->save($permission);
                        }
                    }
                }
            }
        }
    }
}
