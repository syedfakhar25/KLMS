<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    use HasFactory;

    protected $fillable=[
        'premesis_id',
        'species',
        'breed',
        'class',
        'gender',
        'birth_date',
        'dam_tag',
        'old_dam_tag',
        'sire_tag',
        'old_sire_tag',
        'production_type',
        'status',
        'image',
    ];


}
