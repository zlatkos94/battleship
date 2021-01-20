<?php

namespace Database\Seeders;

use App\Models\Accident;
use Illuminate\Database\Seeder;

class AccidentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Accident::create([

            'name' => 'seasickness',
            'mortality_rate' => '25',
            'probability_percentage'=> '35',

        ]);
        Accident::create([
            'name' => 'storm',
            'mortality_rate' => '35',
            'probability_percentage'=> '30',

        ]);
        Accident::create([
            'name' => 'starvation',
            'mortality_rate' => '20',
            'probability_percentage'=> '15',
        ]);
        Accident::create([
            'name' => 'revolt',
            'mortality_rate' => '20',
            'probability_percentage'=> '20',

        ]);
    }
}
