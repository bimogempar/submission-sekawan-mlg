<?php

namespace Database\Seeders;

use App\Models\Rent;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Seeder;

class RentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rent = Rent::factory(8)->create();
    }
}
