<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    public function board()
    {
        return $this->belongsTo(Board::class);
    }
}
