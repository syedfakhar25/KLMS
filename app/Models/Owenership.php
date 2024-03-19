<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Owenership extends Model
{
    use HasFactory;

    protected  $fillable = [
        'premesis_id',
        'owner_name',
        'address',
        'number',
        'cnic',
        'company_name',
        'reg_no',
        'type',
    ];
}
