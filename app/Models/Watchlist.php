<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Watchlist 
{
    public static function add_to_watchlist($user_id_value, $anime_id_value )
    {
        DB::insert("INSERT INTO watchlist (user_id, anime_id) VALUES (:user_id, :anime_id )",[
            "user_id"=>$user_id_value,
            "anime_id"=>$anime_id_value
        ]);
    }
}