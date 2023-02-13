<?php

namespace Naykel\Authit\Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{

    public function run()
    {
        User::create([
            'name' => 'Super User',
            'email' => 'super@example.com.au',
            'password' => bcrypt('1'),
            'email_verified_at' => now(),
        ])->assignRole('super')->givePermissionTo('access admin');

        // User::create([
        //     'name' => 'Admin User',
        //     'email' => 'admin@example.com',
        //     'password' => bcrypt('1'),
        //     'email_verified_at' => now(),
        // ])->assignRole('admin');

        User::create([
            'name' => 'Jimmy Peters',
            'email' => 'user@example.com',
            'password' => bcrypt('1'),
            'email_verified_at' => now(),
        ])->assignRole('user');
    }
}
