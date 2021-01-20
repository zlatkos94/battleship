<?php

namespace Database\Seeders;

use App\Models\Ship;
use Illuminate\Database\Seeder;

class ShipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ship::create([
            'name' => 'test1',
            'fk_ship_type' =>'1'
        ]);
        Ship::create([
            'name' => 'test2',
            'fk_ship_type' =>'2'

        ]);
        Ship::create([
            'name' => 'test3',
            'fk_ship_type' =>'3'
        ]);
        Ship::create([
            'name' => 'test4',
            'fk_ship_type' =>'4'
        ]);

    }
}
