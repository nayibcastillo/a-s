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
    public function cup()
    {
        return $this->hasMany(CupLaboratory::class, 'id_laboratory', 'id');
    }
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient', 'id')->with('municipality')->with('eps');
    }
}
