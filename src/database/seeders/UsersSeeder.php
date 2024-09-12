<?php

namespace Naykel\Authit\Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{

    public function run()
    {
        $super = config('authit.use_single_name_field')
            ? ['name' => 'Super']
            : ['first_name' => 'Super', 'last_name' => 'User'];

        $super += [
            'email' => 'super@example.com',
            'password' => bcrypt('1'),
            'email_verified_at' => now(),
        ];

        $admin = config('authit.use_single_name_field')
            ? ['name' => 'Admin']
            : ['first_name' => 'Admin', 'last_name' => 'User'];

        $admin += [
            'email' => 'admin@example.com',
            'password' => bcrypt('1'),
            'email_verified_at' => now(),
        ];

        $user = config('authit.use_single_name_field')
            ? ['name' => 'Jimmy Peters']
            : ['first_name' => 'Jimmy', 'last_name' => 'Peters'];

        $user += [
            'email' => 'user@example.com',
            'password' => bcrypt('1'),
            'email_verified_at' => now(),
        ];

        User::create($super)->assignRole('super')->givePermissionTo('access admin');
        User::create($admin)->assignRole('admin')->givePermissionTo('access admin');
        User::create($user)->assignRole('user');
    }
}
