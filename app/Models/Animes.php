<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Animes 
{
    public $id;

    public static function all()
    {
        return DB::select("SELECT * FROM animes");
    }

    public static function read_anime($id)
    {
        return DB::select("SELECT * FROM animes WHERE id = ?", [$id])[0];
    }
}