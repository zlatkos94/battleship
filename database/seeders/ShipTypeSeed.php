<?php

namespace Database\Seeders;

use App\Models\ShipType;
use Illuminate\Database\Seeder;


class ShipTypeSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ShipType::create([
            'name' => 'submarine',
            'power' => '7',
            'fk_accident_protect' => '2',
        ]);
        ShipType::create([
            'name' => 'battleship',
            'power' => '10',
            'fk_accident_protect' => '4',
        ]);
        ShipType::create([
            'name' => 'destroyer',
            'power' => '8',
            'fk_accident_protect' => '1',
        ]);
        ShipType::create([
            'name' => 'frigate',
            'power' => '9',
            'fk_accident_protect' => '3',
        ]);
    }
}
