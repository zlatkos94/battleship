<?php

namespace App\Http\Controllers;

use App\Models\Accident;
use App\Models\Ship;
use Illuminate\Http\Request;
use \Illuminate\Support\Facades\DB;

class ShipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('battles.index');
    }

    public function prediction()
    {

         $data =  \DB::table('ships')
             ->select('ships.id','ships.name',
                 \DB::raw('SUM(soldiers.attack)*ship_types.power as total, count(*) as counter') )
             ->join('ship_types', 'ship_types.id', '=', 'ships.fk_ship_type')
             ->join('soldiers', 'soldiers.fk_ship', '=', 'ships.id')
             ->groupBy('ships.id','ships.name','ship_types.power')
             ->get();

        // return response()->json($data);

        return view('battles.prediction',compact('data'));

    }

    public function start()
    {
        DB::table('ships')->delete();
        DB::table('soldiers')->delete();

        return view('battles.gameStart');
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ship  $ship
     * @return \Illuminate\Http\Response
     */
    public function show(Ship $ship)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ship  $ship
     * @return \Illuminate\Http\Response
     */
    public function edit(Ship $ship)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ship  $ship
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ship $ship)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ship  $ship
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ship $ship)
    {
        //
    }
}
