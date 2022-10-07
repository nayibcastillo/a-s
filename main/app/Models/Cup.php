<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Color;

class Cup extends Model
{
    protected $fillable = [
        'code',
        'description',
        'speciality',
        'nickname',
        'cup_type_id',
        'color_id'
    ];

    /* RELATIONSHIPS */
    public function specialities()
    {
        return $this->belongsToMany(Speciality::class);
    }

    public function colors()
    {
        return $this->belongsTo(Color::class, 'color_id');
    }

    public function type_cup()
    {
        return $this->belongsTo(Cup_type::class, 'cup_type_id');
    }
}
