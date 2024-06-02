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
        $districts = $divisions = $villages = $tehsils = $councils = $premesesTypes = [];
        $districtsResult = DB::select('SELECT * FROM districts');
        $divisionsResult = DB::select('SELECT * FROM divisions');
        $villagesResult = DB::select('SELECT * FROM villages');
        $tehsilsResult = DB::select('SELECT * FROM tehsils');
        $councilsResult = DB::select('SELECT * FROM councils');
        $premesestypeResult = DB::select('SELECT * FROM premises_types');

// Organize district data into key-value pairs
        $districts= [];
        foreach ($districtsResult as $district) {
            // $districts[$district->id] = $district->district_name;
            $districts[] = ['key' => $district->id, 'value' => $district->district_name, 'parent_id'=>$district->division_id];

        }

// Organize division data into key-value pairs
        $divisions= [];
        foreach ($divisionsResult as $division) {
            // $divisions[$division->id] = $division->division_name;
            $divisions[] = ['key' => $division->id, 'value' => $division->division_name];

        }

// Organize village data into key-value pairs
        $villages=[];
        // foreach ($villagesResult as $village) {
        //     $villages[$village->id] = $village->name;
        // }
        foreach ($villagesResult as $village) {
            $villages[] = ['key' => $village->id, 'value' => $village->name, 'parent_id'=>$village->uc_id];
        }

// Organize tehsil data into key-value pairs
        $tehsils=[];
        foreach ($tehsilsResult as $tehsil) {
            // $tehsils[$tehsil->id] = $tehsil->tehsil_name;
            $tehsils[] = ['key' => $tehsil->id, 'value' => $tehsil->tehsil_name, 'parent_id'=>$tehsil->district_id];
        }

// Organize council data into key-value pairs
        $councils=[];
        foreach ($councilsResult as $council) {
            // $councils[$council->id] = $council->council_name;
            $councils[] = ['key' => $council->id, 'value' => $council->council_name, 'parent_id'=>$council->tehsil_id];
        }
// Organize premesesType data into key-value pairs
        $premesesTypes=[];
        foreach ($premesestypeResult as $type) {
            // $councils[$council->id] = $council->council_name;
            $premesesTypes[] = ['key' => $type->id, 'value' => $type->type];
        }

// Fetch data for species, productions, species_productions, and breeds
        $speciesResult = DB::select('SELECT * FROM species');
        $productionsResult = DB::select('SELECT sp.production_id, sp.specie_id, p.name AS production_name FROM species_productions sp JOIN productions p ON sp.production_id = p.id');
        // $speciesProductionsResult = DB::select('SELECT * FROM species_productions');
        $breedsResult = DB::select('SELECT * FROM breeds');

// Organize species data into key-value pairs
        $species=[];
        foreach ($speciesResult as $specie) {
            // $species[$specie->id] = $specie->name;
            $species[] = ['key' => $specie->id, 'value' => $specie->name];

        }

// Organize production data into key-value pairs
        // $productions=[];
        // foreach ($productionsResult as $production) {
        //     // $productions[$production->id] = $production->name;
        //     $productions[] = ['key' => $production->id, 'value' => $production->name];

        // }

//         $speciesProductions=[];

// // Organize species productions data into key-value pairs
//         foreach ($speciesProductionsResult as $speciesProduction) {
//             // Assuming species_productions table has a unique id field
//             $speciesProductions[$speciesProduction->id] = [
//                 'species_id' => $speciesProduction->specie_id,
//                 'production_id' => $speciesProduction->production_id
//             ];
//         }

        $productions = [];
foreach ($productionsResult as $row) {
    $productions[] = [
        'key' => $row->production_id,
        'value' => $row->production_name,
        'parent_id' => $row->specie_id
    ];
}

 

// Organize breed data into key-value pairs
        $breeds=[];
        foreach ($breedsResult as $breed) {
            // $breeds[$breed->id] = $breed->name;
            $breeds[] = ['key' => $breed->id, 'value' => $breed->name, 'parent_id'=>$breed->specie_id];

        }

// Now you have organized data in key-value pairs for each category


        return response()->json(
            [
                'divisions' => $divisions,
                'districts' => $districts,
                'tehsils' => $tehsils,
                'villages' => $villages,
                'councils' => $councils,
                'premices' => $premesesTypes,
                'species' => $species,
                'productions' => $productions,
                'breeds' => $breeds,
            ],
            200);
    }
}
