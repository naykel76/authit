<?php

namespace Naykel\Authit\Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesPermissionsSeeder extends Seeder
{
    public function run()
    {
        // create permissions
        $super = Role::create(['name' => 'super']);
        $admin = Role::create(['name' => 'admin']);
        $user = Role::create(['name' => 'user']);

        // create permissions
        $permission = Permission::create(['name' => 'see all']);
        $permission = Permission::create(['name' => 'access admin']);

        // assign role(s)
        $super->syncPermissions(['see all', 'access admin']);
        $admin->syncPermissions(['access admin']);
    }
}
