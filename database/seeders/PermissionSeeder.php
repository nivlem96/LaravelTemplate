<?php

namespace Database\Seeders;

use App\Helpers\ClassHelper;
use App\Models\Permission;
use App\Models\Role;
use App\Traits\HasPermissions;
use Illuminate\Container\Container;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Symfony\Component\Console\Output\ConsoleOutput;

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
        $out = new ConsoleOutput();

        $models = collect(File::allFiles(app_path($modelNamespace)))->map(function ($item) use ($appNamespace, $modelNamespace) {
            $rel = $item->getRelativePathName();
            $class = sprintf('\%s%s%s', $appNamespace, $modelNamespace ? $modelNamespace . '\\' : '',
                implode('\\', explode('/', substr($rel, 0, strrpos($rel, '.')))));

            return class_exists($class) ? $class : null;
        })->filter();
        foreach ($models as $modelClass) {
            $model = new $modelClass();
            if (ClassHelper::classHasTrait($model, HasPermissions::class)) {
                $className = ClassHelper::getClassName($model);
                foreach ($model::getRolePermissions() as $key => $roles) {
                    $permission = Permission::query()->where('model', $className)->where('key', $key)->first();
                    if ($permission === null) {
                        $out->writeln('Creating ' . $key . ' permission for ' . $className . ' model.');
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
