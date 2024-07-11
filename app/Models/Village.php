<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
    use HasFactory;

    protected $fillable = ['uc_id', 'village_name'];

    public function council()
    {
        return $this->belongsTo(Council::class, 'uc_id');
    }
}
