<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'see-all']);
        Permission::create(['name' => 'access-admin']);

        // update cache to know about the newly created permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create roles and assign created permissions
        $user = Role::create(['name' => 'user']);

        $admin = Role::create(['name' => 'admin']);
        $admin->syncPermissions(['access-admin']);

        $super = Role::create(['name' => 'super']);
        $super->givePermissionTo(['see-all']);
    }
}
