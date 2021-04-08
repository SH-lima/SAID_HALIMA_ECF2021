<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class General
{
    public static function read_reviews($anime_id_value)
    {
    return DB::select(
            "SELECT animes.id, animes.title, reviews.rating, reviews.comment, reviews.user_id, reviews.anime_id  FROM animes  
            INNER JOIN reviews ON reviews.anime_id = animes.id
            WHERE animes.id = (:id)", ["id"=>$anime_id_value] 
            );
    }

    public static function get_top_list()
    {
    return DB::select(
            "SELECT animes.title, ROUND(AVG(rating), 1) AS average FROM reviews
            INNER JOIN animes ON animes.id = reviews.anime_id 
            GROUP BY animes.title");
    }

    public static function get_my_watchlist($user_id_value)
    {
        return DB::select("SELECT animes.title, watchlist.user_id, watchlist.anime_id FROM watchlist
                INNER JOIN users ON watchlist.user_id = users.id
                INNER JOIN animes ON watchlist.anime_id = animes.id
                WHERE users.id = ?", [$user_id_value]);
    }
}