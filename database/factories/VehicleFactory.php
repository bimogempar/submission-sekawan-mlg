<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'type' => $this->faker->randomElement(['MPV', 'SUV', 'Sedan', 'Pickup', 'Truck']),
            'merk' => $this->faker->randomElement(['Toyota', 'Honda', 'Suzuki', 'Daihatsu', 'Mitsubishi']),
            'fuel' => $this->faker->randomElement(['Solar', 'Bensin', 'Diesel', 'LPG']),
            'maintenance' => $this->faker->dateTimeBetween('-1 years', '+1 years'),
            'history_used' => $this->faker->dateTimeBetween('-1 years', '+1 years'),
            'owner' => $this->faker->randomElement(['PT. ABC', 'PT. DEF', 'PT. GHI', 'PT. JKL', 'PT. MNO']),
            // 'driver' => $this->faker->randomElement(['John Doe', 'Jane Doe', 'Jack Doe', 'Jill Doe', 'Joe Doe']),
            // 'status' => $this->faker->randomElement([0, 1]),
        ];
    }
}
