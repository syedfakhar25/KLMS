<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\District;
use App\Models\Tehsil;
use App\Models\Council;
use App\Models\Village;

class FilterController extends Controller
{
    public function getDistricts()
    {
        $districts = District::all();
        return response()->json($districts);
    }

    public function getTehsils($districtId)
    {
        $tehsils = Tehsil::where('district_id', $districtId)->get();
        return response()->json($tehsils);
    }

    public function getCouncils($tehsilId)
    {
        $councils = Council::where('tehsil_id', $tehsilId)->get();
        return response()->json($councils);
    }

    public function getVillages($councilId)
    {
        $villages = Village::where('uc_id', $councilId)->get();
        return response()->json($villages);
    }
}
