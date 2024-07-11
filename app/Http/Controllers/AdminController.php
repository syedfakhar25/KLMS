<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Disease;
use App\Models\Premesis;
use App\Models\Specie;
use App\Models\User;
use App\Models\Vaccination;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        $data = $this->getDashboardData();
        if ($request->expectsJson()) {
            return response()->json($data, 200);
        }

        return view('dashboard.index', compact('data'));
    }
    private function getDashboardData()
    {
        $user = auth()->user();

        if (is_null($user)) {
            $user = User::find(2);
        }
        $premesisQuery = Premesis::query();

        if ($user->role_id == 1) {
            // $premesisQuery->where('is_approved', 1);
        } elseif ($user->role_id == 2) {
            $premesisQuery->where('user_id', $user->id);
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
        $animals = Animal::whereIn('premesis_id', $premesis_id)->count();
        $vaccinations = Vaccination::whereIn('premises_id', $premesis_id)->count();
        $diseases = Disease::whereIn('premises_id', $premesis_id)->count();

        return [
            'premises' => $premesis->count(),
            'animals' => $animals,
            'vaccination' => $vaccinations,
            'labtest' => '-',
            'disease' => $diseases,
            'breeding' => '-',
            'birth' => '-',
            'movement' => '-',
            'quarantine' => '-',
            'slaughtered' => '-',
            'exported' => '-',
        ];
    }

    public function showPremises(Request $request)
    {
        $user = auth()->user();
    
        if (is_null($user)) {
            $user = User::find(2);
        }
        $premesisQuery = Premesis::with('district')->get();
        dd($premesisQuery);
    
        // Apply role-based filters
        if ($user->role_id == 1) {
            // $premesisQuery->where('is_approved', 1);
        } elseif ($user->role_id == 2) {
            $premesisQuery->where('user_id', $user->id);
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
    
        $premises = $premesisQuery;
    dd($premises);
        return view('premises.index', compact('premises'));
    }
    
}
