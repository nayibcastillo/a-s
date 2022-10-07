<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cup_type extends Model
{
    protected $table = "cups_type";

    protected $fillable = ['name', 'color_id'];

    /* RELATIONSHIPS */

    public function color()
    {
        return $this->hasOne(Color::class, 'color_id');
    }
}
