<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
        $this->call(VehicleSeeder::class);

        $user = User::all();
        Vehicle::all()->each(function ($vehicle) use ($user) {
            $vehicle->user()->attach(
                $user->except(1, 2, 3)->random(1, 3)->pluck('id')->toArray()
            );
        });
    }
}
