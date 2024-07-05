<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Disease;
use App\Models\Premesis;
use App\Models\Specie;
use App\Models\Vaccination;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard() {
        $premesis= Premesis::all();
        if (auth()->user()->role_id == 1) {
            if(auth()->user()->village){
                $premesis= $premesis->where('village',auth()->user()->village);
            }
            $premesis_id=$premesis->pluck('id');
            $animals =Animal::wherein('premesis_id', $premesis_id); 
            $vaccinations =Vaccination::wherein('premesis_id', $premesis_id); 
            $diseases =Disease::wherein('premesis_id', $premesis_id); 
            $species =Specie::wherein('premesis_id', $premesis_id); 
            // $premesis = Premesis::where(['province'=>, 	'district'=>, 'tehsil'=>,'uc'=>, 'village'=>]);
        }

        return response()->json(
            [
                'premises' => $premesis->count(),
                'animals' => $animals->count(),
                'vaccination' => $vaccinations->count(),
                'labtest' => '-',
                'dieses' => $diseases->count(),
                'species' => $species->count(),
                'breeding' => '-',
                'birth' => '-',
                'movment' => '-',
                'quarantine' => '-',
                'slaughtered' => '-',
                'exported' => '-',
            ],
            200);
    }
}
