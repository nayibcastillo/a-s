<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laboratories extends Model
{
    protected $fillable = [
        'patient',
        'date',
        'contract_id',
        'professional_id',
        'cie10_id',
        'motivo_id',
        'observations',
        'laboratory_id',
        'ips_id',
        'specialty_id',
        'hour',
        'status',
    ];
}
