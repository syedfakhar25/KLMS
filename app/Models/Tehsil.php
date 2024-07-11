<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tehsil extends Model
{
    use HasFactory;

    protected $fillable = ['district_id', 'tehsil_name'];

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function councils()
    {
        return $this->hasMany(Council::class);
    }
}
