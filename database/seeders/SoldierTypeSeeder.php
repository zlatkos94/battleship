<?php

namespace Database\Seeders;

use App\Models\SoldierType;
use Illuminate\Database\Seeder;

class SoldierTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SoldierType::create([

            'name' => 'captain',
        ]);
        SoldierType::create([

            'name' => 'soldiers',
        ]);
    }
}
