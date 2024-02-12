<?php

namespace Naykel\Authit\Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{

    public function run()
    {

        $super = config('authit.use_single_name_field')
            ? ['name' => 'Super User']
            : ['firstname' => 'Super', 'lastname' => 'User'];

        $super += [
            'email' => 'super@example.com.au',
            'password' => bcrypt('1'),
            'email_verified_at' => now(),
        ];

        User::create($super)->assignRole('super')->givePermissionTo('access admin');

        $user = config('authit.use_single_name_field')
            ? ['name' => 'Jimmy Peters']
            : ['firstname' => 'Jimmy', 'lastname' => 'Peters'];

        $user += [
            'email' => 'user@example.com',
            'password' => bcrypt('1'),
            'email_verified_at' => now(),
        ];

        User::create($user)->assignRole('user');
    }
}
