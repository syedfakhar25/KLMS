<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vaccination extends Model
{
    use HasFactory;

    protected $fillable=[
        'specie',
        'vacc_type',
        'vacc_name',
        'feed_type',
        'sub_type',
        'date',
    ];


    public function animal(){
        return $this->hasMany(Animal::class);
    }
}
