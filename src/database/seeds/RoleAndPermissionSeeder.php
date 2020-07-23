<?php

use Illuminate\Database\Seeder;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleInDatabase = \Spatie\Permission\Models\Role::where('name', config('permission.default_roles')[0]);
        if ($roleInDatabase->count() < 1) {
            foreach (config('permission.default_roles') as $role) {
                \Spatie\Permission\Models\Role::create([
                    'name' => $role
                ]);
            }
        }

        $permissionInDatabase = \Spatie\Permission\Models\Permission::where('name', config('permission.default_permissions')[0]);
        if ($permissionInDatabase->count() < 1) {
            foreach (config('permission.default_permissions') as $permission) {
                \Spatie\Permission\Models\Permission::create([
                    'name' => $permission
                ]);
            }
        }

    }
}
