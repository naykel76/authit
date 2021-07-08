<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesPermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create permissions
        $permission = Permission::create(['name' => 'access admin']);

        $permission = Permission::create(['name' => 'create articles']);
        $permission = Permission::create(['name' => 'read articles']);
        $permission = Permission::create(['name' => 'edit articles']);
        $permission = Permission::create(['name' => 'delete articles']);

        $permission = Permission::create(['name' => 'create pages']);
        $permission = Permission::create(['name' => 'read pages']);
        $permission = Permission::create(['name' => 'edit pages']);
        $permission = Permission::create(['name' => 'delete pages']);

        // create roles and assign permissions
        $role = Role::create(['name' => 'super']);

        $role = Role::create(['name' => 'admin']);
        $role->syncPermissions(['create articles', 'read articles', 'edit articles', 'delete articles']);
        
        $role = Role::create(['name' => 'writer']);
        $role->syncPermissions(['create articles', 'read articles', 'edit articles']);

        $role = Role::create(['name' => 'user']);
    }
}
