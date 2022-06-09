<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{

    public function run()
    {
        User::create([
            'name' => 'Nathan Watts',
            'email' => 'nathan@naykel.com.au',
            'password' => bcrypt('1'),
            'email_verified_at' => now(),
        ])->assignRole('super')->givePermissionTo('access admin');

        User::create([
            'name' => 'Angela McAdmin',
            'email' => 'admin@example.com',
            'password' => bcrypt('1'),
            'email_verified_at' => now(),
        ])->assignRole('admin');

        User::create([
            'name' => 'Michelle Writer',
            'email' => 'writer@example.com',
            'password' => bcrypt('1'),
            'email_verified_at' => now(),
        ])->assignRole('writer');

        User::create([
            'name' => 'Jimmy Peters',
            'email' => 'user@example.com',
            'password' => bcrypt('1'),
            'email_verified_at' => now(),
        ])->assignRole('user');
    }
}
