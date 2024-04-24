<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AllDataController extends Controller
{
    public function allData(){
        $districts = DB::select('SELECT * FROM districts');
        $divisions = DB::select('SELECT * FROM divisions');
        $villages = DB::select('SELECT * FROM villages');
        $tehsils = DB::select('SELECT * FROM tehsils');
        $councils = DB::select('SELECT * FROM councils');

        //animals data
        $species = DB::select('SELECT * FROM species');
        $productions = DB::select('SELECT * FROM productions');
        $species_productions = DB::select('SELECT * FROM species_productions');
        $breeds = DB::select('SELECT * FROM breeds');

        return response()->json(
            [
                'divisions' => $divisions,
                'districts' => $districts,
                'tehsils' => $tehsils,
                'villages' => $villages,
                'councils' => $councils,
                'species' => $species,
                'productions' => $productions,
                'species_productions' => $species_productions,
                'breeds' => $breeds,

            ],
            200);
    }
}
