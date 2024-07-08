<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'title' => 'Admin',
            'description' => 'AJK Administrator role',
        ]);
        Role::create([
            'title' => 'User',
            'description' => 'AJK Administrator role',
        ]);
        Role::create([
            'title' => 'District Admin',
            'description' => 'District Administrator role',
        ]);
        Role::create([
            'title' => 'Tehsil Admin',
            'description' => 'Tehsil Administrator role',
        ]);
        Role::create([
            'title' => 'UC Admin',
            'description' => 'UC Administrator role',
        ]);
        Role::create([
            'title' => 'Village Admin',
            'description' => 'Village Administrator role',
        ]);
    }
}
