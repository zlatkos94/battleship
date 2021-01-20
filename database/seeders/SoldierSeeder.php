<?php

namespace Database\Seeders;
use App\Models\Soldier;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

use Illuminate\Database\Eloquent\Factories\Factory;

class SoldierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++)
        {
            Soldier::create([
                'name' => $faker->name,
                'attack' => $faker->numberBetween(1,10),
                'defense' => $faker->numberBetween(1,10),
                'fk_soldier_type' => '2',
                'life' =>1,

            ]);

        }
    }
}
