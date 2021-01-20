<?php

namespace Database\Seeders;

use App\Models\Ship;
use App\Models\ShipAttribute;
use App\Models\Soldier;
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
        $this->call(AccidentSeeder::class);

        $this->call(ShipTypeSeed::class);

        $this->call(SoldierTypeSeeder::class);

        //$this->call(ShipSeeder::class);

        // $this->call(SoldierSeeder::class);


    }
}
