<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AllDataController extends Controller
{
    public function allData(){
        /*$districts = DB::select('SELECT * FROM districts');
        $divisions = DB::select('SELECT * FROM divisions');
        $villages = DB::select('SELECT * FROM villages');
        $tehsils = DB::select('SELECT * FROM tehsils');
        $councils = DB::select('SELECT * FROM councils');

        //animals data
        $species = DB::select('SELECT * FROM species');
        $productions = DB::select('SELECT * FROM productions');
        $species_productions = DB::select('SELECT * FROM species_productions');
        $breeds = DB::select('SELECT * FROM breeds');*/
        // Fetch data for districts, divisions, villages, tehsils, and councils
        $districts = $divisions = $villages = $tehsils = $councils = [];
        $districtsResult = DB::select('SELECT * FROM districts');
        $divisionsResult = DB::select('SELECT * FROM divisions');
        $villagesResult = DB::select('SELECT * FROM villages');
        $tehsilsResult = DB::select('SELECT * FROM tehsils');
        $councilsResult = DB::select('SELECT * FROM councils');

// Organize district data into key-value pairs
        foreach ($districtsResult as $district) {
            $districts[$district->id] = $district->district_name;
        }

// Organize division data into key-value pairs
        foreach ($divisionsResult as $division) {
            $divisions[$division->id] = $division->division_name;
        }

// Organize village data into key-value pairs
        foreach ($villagesResult as $village) {
            $villages[$village->id] = $village->name;
        }

// Organize tehsil data into key-value pairs
        foreach ($tehsilsResult as $tehsil) {
            $tehsils[$tehsil->id] = $tehsil->tehsil_name;
        }

// Organize council data into key-value pairs
        foreach ($councilsResult as $council) {
            $councils[$council->id] = $council->council_name;
        }

// Fetch data for species, productions, species_productions, and breeds
        $species = $productions = $speciesProductions = $breeds = [];
        $speciesResult = DB::select('SELECT * FROM species');
        $productionsResult = DB::select('SELECT * FROM productions');
        $speciesProductionsResult = DB::select('SELECT * FROM species_productions');
        $breedsResult = DB::select('SELECT * FROM breeds');

// Organize species data into key-value pairs
        foreach ($speciesResult as $specie) {
            $species[$specie->id] = $specie->name;
        }

// Organize production data into key-value pairs
        foreach ($productionsResult as $production) {
            $productions[$production->id] = $production->name;
        }

// Organize species productions data into key-value pairs
        foreach ($speciesProductionsResult as $speciesProduction) {
            // Assuming species_productions table has a unique id field
            $speciesProductions[$speciesProduction->id] = [
                'species_id' => $speciesProduction->specie_id,
                'production_id' => $speciesProduction->production_id
            ];
        }

// Organize breed data into key-value pairs
        foreach ($breedsResult as $breed) {
            $breeds[$breed->id] = $breed->name;
        }

// Now you have organized data in key-value pairs for each category


        return response()->json(
            [
                'divisions' => $divisions,
                'districts' => $districts,
                'tehsils' => $tehsils,
                'villages' => $villages,
                'councils' => $councils,
                'species' => $species,
                'productions' => $productions,
                'species_productions' => $speciesProductions,
                'breeds' => $breeds,

            ],
            200);
    }
}
