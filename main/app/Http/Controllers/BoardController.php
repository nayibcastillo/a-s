<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Board;
use App\Traits\ApiResponser;
use Illuminate\Support\Facades\DB;

class BoardController extends Controller
{
    use ApiResponser;
    public function getData(){
        /* $board = DB::table('boards')->get();
        return $board; */
        return $this->success(Board::get());

    }
}
