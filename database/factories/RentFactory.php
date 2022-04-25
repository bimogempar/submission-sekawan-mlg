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
            'rent_date' => now(),
            'fuel' => $this->faker->numberBetween(1, 10),
            'driver' => $users->random()->id,
            'approval' => $users->where('role', 3)->random()->id,
            'vehicle_id' => $vehicles->random()->id,
            'rent_date' => now(),
            'status' => random_int(0, 1),
        ];
    }
}
