<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PremisesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 5; $i++) {
            DB::table('premeses')->insert([
                'name' => 'Premise ' . ($i + 1),
                'province' => 'Province ' . ($i + 1),
                'district' => 'District ' . ($i + 1),
                'tehsil' => 'Tehsil ' . ($i + 1),
                'uc' => 'UC ' . ($i + 1),
                'village' => 'Village ' . ($i + 1),
                'type' => 'Type ' . ($i + 1),
                'status' => 'Status ' . ($i + 1),
                'latitude' => 'Latitude ' . ($i + 1),
                'longitude' => 'Longitude ' . ($i + 1),
                'quarantine_facility' => rand(0, 1),
                'nearby_hospital' => 'Nearby Hospital ' . ($i + 1),
                'vet_name' => 'Vet Name ' . ($i + 1),
                'vet_contact' => 'Vet Contact ' . ($i + 1),
                'assistant_name' => 'Assistant Name ' . ($i + 1),
                'assistant_contact' => 'Assistant Contact ' . ($i + 1),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
