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
            if(auth()->user()->village){
                $premesis= $premesis->where('village',auth()->user()->village);
            }
            elseif(auth()->user()->uc){
                $premesis= $premesis->where('uc',auth()->user()->uc);
          
            }
            elseif(auth()->user()->tehsil){
                $premesis= $premesis->where('tehsil',auth()->user()->tehsil);
        
            }
            elseif(auth()->user()->district){
                $premesis= $premesis->where('district',auth()->user()->district);
            
            }
            elseif(auth()->user()->province){
                $premesis= $premesis->where('province',auth()->user()->province);
            }
            $premesis_id=$premesis->pluck('id');
            $animals =Animal::wherein('premesis_id', $premesis_id); 
            $vaccinations =Vaccination::wherein('premises_id', $premesis_id); 
            $diseases =Disease::wherein('premises_id', $premesis_id); 
            // $premesis = Premesis::where(['province'=>, 	'district'=>, 'tehsil'=>,'uc'=>, 'village'=>]);

        return response()->json(
            [
                'premises' => $premesis->count(),
                'animals' => $animals->count(),
                'vaccination' => $vaccinations->count(),
                'labtest' => '-',
                'dieses' => $diseases->count(),
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
