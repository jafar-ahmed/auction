<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = [

            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456'),
            'contacts' => '+2 (800) 555-35-35',
            'avatar' => 'avatar/logo.png',
            'is_admin' => 'admin'
        ];

        $user = [
            'name' => 'user',
            'email' => 'user@gmail.com',
            'password' => Hash::make('123456'),
            'contacts' => '+1 (700) 444-45-45',
            'avatar' => 'avatar/logo.png',
            'is_admin' => ''
        ];

        User::create($admin);
        User::create($user);
    }
}
