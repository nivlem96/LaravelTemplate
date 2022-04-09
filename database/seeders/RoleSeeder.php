<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Role::getDefaultRoles() as $role) {
            if (Role::query()->where('title', $role)->first() !== null) {
                continue;
            }
            $roleModel = new Role();
            $roleModel->title = $role;
            $roleModel->save();
        }
    }
}
