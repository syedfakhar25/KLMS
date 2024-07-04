<?php

namespace App\Http\Controllers;

use App\Models\Premesis;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard() {
        
        if (auth()->user()->role_id == 1) {
            $premesis = Premesis::all();
        }

        return response()->json(
            [
                'premises' => $premesis,
                'animals' => 20,
                'vaccination' => 30,
                'labtest' => 20,
                'dieses' => 50,
                'species' => 90,
                'productions' => 90,
                'species_productions' => 90,
                'breeds' => 90,

            ],
            200);
    }
}
