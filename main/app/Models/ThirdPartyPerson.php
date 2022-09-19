<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;

class ThirdPartyPerson extends Authenticatable implements JWTSubject
{
    use Notifiable;
    protected $fillable = [
        'name',
        'n_document',
        'landline',
        'cell_phone',
        'email',
        'position',
        'observation',
        'third_party_id',
        'laboratory_id',
        'usuario',
        'password',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function laboratory()
    {
        return $this->belongsTo(LaboratoriesPlace::class, 'laboratory_id', 'id');
    }

}
