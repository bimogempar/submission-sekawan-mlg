<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

class RentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $vehicles = Vehicle::all();
        $users = User::all();
        return [
            'driver' => $users->random()->id,
            'approval' => $users->random()->id,
            'vehicle_id' => $vehicles->random()->id,
            'rent_date' => now(),
            'status' => random_int(0, 1),
        ];
    }
}
