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

        return response()->json(
            [
                'divisions' => $divisions,
                'districts' => $districts,
                'tehsils' => $tehsils,
                'villages' => $villages,
                'councils' => $councils,

            ],
            200);
    }
}
