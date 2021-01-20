<?php

namespace App\Http\Controllers;

use App\Models\Accident;
use App\Models\Ship;
use App\Models\Soldier;
use Faker\Factory as Faker;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Repositories\Repository;

class SoldierController extends Controller
{
    const ACCIDENT_SICKNESS = 1;
    const ACCIDENT_STORM = 2;
    const ACCIDENT_STARVATION = 3;
    const ACCIDENT_REVOLT = 4;

    const TYPE_CAPTAIN = 1;
    const TYPE_SOLDIER = 2;

    protected $model;

    public function __construct(Soldier $soldier)
    {
        // set the model
        $this->model = new Repository($soldier);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'ship.*' => 'required',
            'fk_ship_type.*' => 'required',
            'name.*' => 'required',
            'number_of_soldier.*' => 'required|numeric'
        ],
            [
                'ship.*.required' => 'Type suggested name',
                'fk_ship_type.*.required' => 'Type suggested name',
                'name.*.required' => 'Type name of crew',
                'number_of_soldier.*.required' => 'Type number of soldier',

            ]);

        $input = $request->all();
        $condition = $input['fk_ship_type'];
        $faker = Faker::create();

        foreach ($condition as $key => $value) {
            $ship = new Ship();
            $ship->name = $input['name'][$key];
            $ship->fk_ship_type = $input['fk_ship_type'][$key];
            $ship->save();

            $numberOfSoldiers = (int)$input['number_of_soldier'][$key];

            $attack = $faker->numberBetween(11, 20);
            Soldier::create([
                'name' => $faker->name,
                'attack' => $attack,
                'fk_soldier_type' => self::TYPE_CAPTAIN,
                'fk_ship' => $ship->id,
                'life' => 1,
            ]);
            for ($i = 0; $i < $numberOfSoldiers - 1; $i++) {

                $attack = $faker->numberBetween(2, 10);

                Soldier::create([
                    'name' => $faker->name,
                    'attack' => $attack,
                    'fk_soldier_type' => self::TYPE_SOLDIER,
                    'fk_ship' => $ship->id,
                    'life' => 1,
                ]);
            }
        }
        return redirect()->route('battles.prediction')
            ->with('success', 'Ships and soldiers created successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Soldier $soldier
     * @return \Illuminate\Http\Response
     */
    public function show(Soldier $soldier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Soldier $soldier
     * @return \Illuminate\Http\Response
     */
    public function edit(Soldier $soldier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Soldier $soldier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Soldier $soldier)
    {

    }

    private function getDeathNumber($mortalityRate, $numberOfSoldiers)
    {
        return round($mortalityRate / 100 * $numberOfSoldiers);
    }

    public function killSoldiers()
    {
        $accident_id = $this->RandomId();
        $soldiers = \DB::table('soldiers')->inRandomOrder()->select('soldiers.name as soldier', 'soldiers.id', 'ships.name', 'accidents.mortality_rate')
            ->join('ships', 'ships.id', '=', 'soldiers.fk_ship')
            ->join('ship_types', 'ship_types.id', '=', 'ships.fk_ship_type')
            ->join('accidents', 'accidents.id', '=', 'ship_types.fk_accident_protect')
            ->where('life', 1)->where('ship_types.fk_accident_protect', '!=', $accident_id)
            ->get();

        $accidents = \DB::table('accidents')->select('accidents.id', 'accidents.mortality_rate')->where('id', $accident_id)->first();
        $number_of_soldiers = count($soldiers);
        $deathNumber = $this->getDeathNumber($accidents->mortality_rate, $number_of_soldiers);

        if ($accidents->id == self::ACCIDENT_SICKNESS) {
            for ($i = 0; $i < $deathNumber; $i++) {
                $affected = \DB::table('soldiers')
                    ->where('id', $soldiers[$i]->id)
                    ->decrement('attack', 2);
            }
        }
        if ($accidents->id == self::ACCIDENT_STORM) {
            for ($i = 0; $i < round($deathNumber); $i++) {
                $affected = \DB::table('soldiers')
                    ->where('id', $soldiers[$i]->id)
                    ->update(['life' => 0]);
            }
        }
        if ($accidents->id == self::ACCIDENT_STARVATION || $accidents->id == self::ACCIDENT_REVOLT) {
            $affected = \DB::table('soldiers')->inRandomOrder()
                ->where('fk_soldier_type', 1)->take(1)
                ->update(['life' => 0]);

        }
        $id = $accidents->id;

        return redirect()->route('battles.finish', compact('id'))
            ->with('success', 'Ships and soldiers created successfully.');
    }


    public function finish(Request $request)
    {
        $accident_id = $request->all();
        $accident = Accident::where('id', $accident_id)->first();
        $accident_name = $accident->name;
        $finish_data = $this->getFinishData();
        $dead_soldiers = $this->getDeadSoldiers();
        return view('battles.finish', compact('finish_data', 'dead_soldiers', 'accident_name'))->with('i');

    }

    public function getFinishData()
    {
        $finish_data = \DB::table('ships')
            ->select('ships.id', 'ships.name', 'ship_types.name as shipName',
                \DB::raw('SUM(soldiers.attack)*ship_types.power as total, count(*) as counter'))
            ->join('ship_types', 'ship_types.id', '=', 'ships.fk_ship_type')
            ->join('soldiers', 'soldiers.fk_ship', '=', 'ships.id')
            ->where('soldiers.life', '1')
            ->groupBy('ships.id', 'ships.name', 'ship_types.name', 'ship_types.power')
            ->orderBy('total', 'desc')
            ->get();

        return $finish_data;
    }

    /**
     * @return mixed
     */
    private function getDeadSoldiers()
    {
        $dead_soldiers = \DB::table('soldiers')
            ->select('ships.id', 'ships.name',
                \DB::raw('COUNT(soldiers.life) as died'))
            ->join('ships', 'ships.id', '=', 'soldiers.fk_ship')
            ->join('ship_types', 'ship_types.id', '=', 'ships.fk_ship_type')
            ->where('soldiers.life', '0')
            ->groupBy('ships.id', 'ships.name')
            ->orderBy('died', 'desc')
            ->get();

        return $dead_soldiers;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Soldier $soldier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Soldier $soldier)
    {
        //
    }

    private function RandomId()
    {
        $random = rand(1, 100);
        $accidents = \DB::table('accidents')->select('*')->get();
        $w = 0;
        foreach ($accidents as $accident) {
            $w += $accident->probability_percentage;
            if ($w > $random) {
                $accident_id = $accident->id;
                break;
            }
        }

        return $accident_id;
    }
}
