<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CupLaboratory extends Model
{
    protected $fillable = [
        'id_laboratory',
        'id_cup',
        'file',
        'state'
    ];
}
