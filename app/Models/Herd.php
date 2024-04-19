<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Herd extends Model
{
    use HasFactory;

    protected $fillable = [
        'premesis_id',
        'name',
        'quantity'
    ];
    
}
