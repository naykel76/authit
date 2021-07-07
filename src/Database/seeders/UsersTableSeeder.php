<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    
    public function run()
    {
        User::create([
            'name' => 'Nathan Watts',
            'email' => 'nathan@naykel.com.au',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
        ])->assignRole('super');

        User::create([
            'name' => 'Angela McAdmin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
        ])->assignRole('admin');

        User::create([
            'name' => 'Michelle Writer',
            'email' => 'writer@writer.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
        ])->assignRole('writer');

        User::create([
            'name' => 'Jimmy Peters',
            'email' => 'user@user.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
        ])->assignRole('user');
    }
}
