<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Animes;
use App\Models\Reviews;
use App\Models\General;
use App\Models\Watchlist;
use Illuminate\Support\Facades\DB;

class AnimeController 
{
    
    public function read()
    {
        // model
        $animes = Animes::all();
        // view
        return view('welcome', ["animes" => $animes]);
    }

    public function read_anime($id, Request $request)
    {
        // model
        $anime = Animes::read_anime($id);
        $rating=Reviews::get_rating($id);
        session(['animeID' => $id]); 
        // view
        return view('anime', [
            "anime" => $anime,
            "rating"=> $rating
        ]);
    }

    public function new_review( Request $request) 
    {
        if (!Auth::check()) 
        {
            // view
            // rediréger vers la page login si utilisateur est pas connecté 
            return redirect()->intended('/login');
        }
        $anime_value =$request->session()->get('animeID');
        $user_value =$request->session()->get('userID');
        $anime_id_value =(int)$anime_value;
        $user_id_value =$user_value->id;
        // Model
        $reviews=General::read_reviews($anime_id_value );
        $userReview = Reviews::get_user_review($user_id_value, $anime_id_value);
        
        // view    
        // permettre d'accéder à la page new_review   
        return view('new_review', [
            "reviews" => $reviews,
            "anime_id_value"=> $anime_id_value,
            "user_id_value"=> $user_id_value,
            "userReview"=>$userReview
            ]);
    }

    public function add_review(Request $request)
    {
        // controller 
        $validated=$request->validate([
            "comment"=>"required",
            "rating"=>"required",
            "anime_id"=>"required",
            "user_id"=>"required"
        ]);
        $rating=$validated["rating"];
        $comment=$validated["comment"];
        $anime_id=$validated["anime_id"];
        $user_id=$validated["user_id"];
        // model
        Reviews::add_review($rating, $comment, $anime_id, $user_id);
        // view
        return redirect('/anime/{id}/new_review');
    }

    public function top_animes()
    {
        // model
        $top_list=General::get_top_list();
        // view
        return view("/top", ["top_list"=>$top_list]);
    }

    public function add_to_watch_list($id, Request $request)
    {
        // controller
        if (!Auth::check()) 
        {
            // view
            // rediréger vers la page login si utilisateur est pas connecté 
            return redirect()->intended('/login');
        }
        // controller
        $anime_value =$request->session()->get('animeID');
        $user_value =$request->session()->get('userID');
        $anime_id_value =(int)$anime_value;
        $user_id_value =$user_value->id;
        // model
        $watchlist=General::get_my_watchlist($user_id_value);
        // controller
        $exist_user = array_search($user_id_value, array_column($watchlist, 'user_id'));
        $exist_anime = array_search($anime_id_value, array_column($watchlist, 'anime_id'));
        if( $exist_user ===false && $exist_anime ===false)
        {
             // model
             Watchlist::add_to_watchlist($user_id_value, $anime_id_value );
            
        }else {
            // afficher un erreur 
         return back()->withErrors([
            'message' => 'Le film est déja ajouté',
          ]);
        
           
        }
        // view
        return redirect("/anime/$id");
        
    }

    public function read_watchlist(Request $request)
    {
        // conroller
        $user_value =$request->session()->get('userID');
        $user_id_value=$user_value->id;
        // model
        $watchlist=General::get_my_watchlist($user_id_value);
        
        // view
        return view("/watchlist", ["watchlist"=>$watchlist]);
    }
}


// Schema::create('watchlist', function( $table){
//     $table->increments('id');
//     $table->foreignId('user_id')->constrained();  
//     $table->foreignId('anime_id')->constrained();
//     $table->timestamps();
// });