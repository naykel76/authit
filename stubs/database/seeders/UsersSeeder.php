<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $super = config('authit.split_name_fields')
            ? ['first_name' => 'Super', 'last_name' => 'User']
            : ['name' => 'Super'];

        $super += [
            'email' => 'super@example.com',
            'password' => bcrypt('1'),
            'email_verified_at' => now(),
        ];

        $admin = config('authit.split_name_fields')
            ? ['first_name' => 'Admin', 'last_name' => 'User']
            : ['name' => 'Admin'];

        $admin += [
            'email' => 'admin@example.com',
            'password' => bcrypt('1'),
            'email_verified_at' => now(),
        ];

        $user = config('authit.split_name_fields')
            ? ['first_name' => 'Jimmy', 'last_name' => 'Peters']
            : ['name' => 'Jimmy Peters'];

        $user += [
            'email' => 'user@example.com',
            'password' => bcrypt('1'),
            'email_verified_at' => now(),
        ];

        User::create($super)->assignRole('super')->givePermissionTo('access-admin');
        User::create($admin)->assignRole('admin')->givePermissionTo('access-admin');
        User::create($user)->assignRole('user');
    }
}
