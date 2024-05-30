<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard() {
        return response()->json(
            [
                'premises' => 18,
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
