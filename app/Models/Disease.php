<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disease extends Model
{
    use HasFactory;

    protected $fillable=[
        'specie',
        'premises_id',
        'disease_type',
        'animals',
        'date',
    ];


    public function animal(){
        return $this->hasMany(Animal::class);
    }
}
