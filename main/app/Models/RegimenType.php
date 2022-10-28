<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegimenType extends Model
{
    protected $fillable = [
        "contract_id",
        "regimen_type_id",
    ];
}
