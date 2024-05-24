<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PremisesTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            ['type' => 'Laboratory', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['type' => 'Farm', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['type' => 'Slaughter house', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['type' => 'Fattening farm', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ];

        DB::table('premises_types')->insert($types);
    }
}
