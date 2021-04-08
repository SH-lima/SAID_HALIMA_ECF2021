<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Reviews 
{
    public static function get_rating($id)
    {
        return DB::select("SELECT  ROUND(AVG(rating), 1) AS average FROM reviews WHERE anime_id = ? ", [$id])[0];
    }

    public static function add_review($rating, $comment, $anime_id, $user_id)
    {
        DB::insert("INSERT INTO reviews (rating, comment, anime_id, user_id) VALUES (:rating, :comment, :anime_id, :user_id) ",
        [
            "rating"=>$rating,
            "comment"=>$comment,
            "anime_id"=>$anime_id,
            "user_id"=>$user_id
        ]);
    }

    public static function get_user_review($user_id_value, $anime_id_value)
    {
        return DB::select("SELECT comment FROM reviews WHERE user_id = :user_id_value AND anime_id = :anime_id_value",
        [
            "user_id_value" => $user_id_value ,
            "anime_id_value" => $anime_id_value
        ]);
    }
}