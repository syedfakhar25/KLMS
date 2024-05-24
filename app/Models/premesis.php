<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class premesis extends Model
{
    use HasFactory;
    public $timestamps = true;

    protected $fillable = [
        'name',
        'user_id',
        'province',
        'district',
        'tehsil',
        'uc',
        'village',
        'type',
        'status',
        'latitude',
        'longitude',
        'quarantine_facility',
        'nearby_hospital',
        'vet_name',
        'vet_contact',
        'assistant_name',
        'assistant_contact',
    ];

    public function ownership()
    {
        return $this->hasMany(Owenership::class);
    }

    public function animal(){
        return $this->hasMany(Animal::class);
    }

    public function herd(){
        return $this->hasMany(Herd::class);
    }
}
