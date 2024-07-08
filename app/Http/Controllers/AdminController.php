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
    public function dashboard()
    {
        $user=auth()->user();
        $premesis = Premesis::all();
        if ($user->roll_id == 1) {
            $premesis = $premesis = $premesis->where(['is_approved'=> 1 ]);;
        } elseif($user->roll_id == 2){
            $premesis = $premesis->where(['user_id'=> $user->user_id]);
        } elseif($user->roll_id == 3){
            $premesis = $premesis->where(['district'=> $user->district,'is_approved'=> 1]);
        } elseif($user->roll_id == 4){
            $premesis = $premesis->where(['tehsil'=> $user->tehsil,'is_approved'=> 1]);
        } elseif($user->roll_id == 5){
            $premesis = $premesis->where(['uc'=> $user->uc,'is_approved'=> 1]);
        } elseif($user->roll_id == 6){
            $premesis = $premesis->where(['village'=> $user->village,'is_approved'=> 1]);
        }  
        $premesis_id = $premesis->pluck('id');
        $animals = Animal::wherein('premesis_id', $premesis_id);
        $vaccinations = Vaccination::wherein('premises_id', $premesis_id);
        $diseases = Disease::wherein('premises_id', $premesis_id);
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
            200
        );
    }
}
