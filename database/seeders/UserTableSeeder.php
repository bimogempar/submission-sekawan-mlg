<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('123123123'),
            'role' => 2,
        ]);

        User::create([
            'name' => 'Bimo',
            'email' => 'bimo@example.com',
            'password' => Hash::make('123123123'),
            'role' => 3,
        ]);

        User::create([
            'name' => 'Rizki',
            'email' => 'rizki@example.com',
            'password' => Hash::make('123123123'),
            'role' => 3,
        ]);

        User::factory(10)->create();
    }
}
