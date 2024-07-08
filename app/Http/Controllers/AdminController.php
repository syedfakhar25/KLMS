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
        $premesisQuery = Premesis::query();
        if ($user->role_id == 1) {
            // $premesisQuery->where('is_approved', 1);
        } elseif ($user->role_id == 2) {
            $premesisQuery->where('user_id', $user->id);  // assuming `user_id` is the primary key and not `user_id`
        } elseif ($user->role_id == 3) {
            $premesisQuery->where('district', $user->district)
                          ->where('is_approved', 1);
        } elseif ($user->role_id == 4) {
            $premesisQuery->where('tehsil', $user->tehsil)
                          ->where('is_approved', 1);
        } elseif ($user->role_id == 5) {
            $premesisQuery->where('uc', $user->uc)
                          ->where('is_approved', 1);
        } elseif ($user->role_id == 6) {
            $premesisQuery->where('village', $user->village)
                          ->where('is_approved', 1);
        }
        $premesis = $premesisQuery->get();
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
