<?php

namespace App\Http\Controllers;

use App\Models\ShipType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Ship;


class ApiController extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request)
    {
        $search = $request->get('term');
        $results = ShipType::where('name', 'LIKE', '%'. $search. '%')->get();

        $data=array();
        foreach ($results as $result) {
            $data[]=array('value'=>$result->name,'id'=>$result->id);
        }

        return response()->json($data);
    }
}
