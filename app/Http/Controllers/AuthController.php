<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;  

class AuthController 
{
    public function login(Request $request)
    {   
        // controller 
        // vérifier la saisie de nom et mot de passe  
        $validated = $request->validate([
          "username" => "required",
          "password" => "required",
        ]);
        // model
        // commencer la session 
        if (Auth::attempt($validated)) {
          // stocker userId dans la session pour pouvoir le utiliser dans toutes les pages 
          $user_id=DB::select("SELECT id FROM users WHERE username =?",[$validated["username"]])[0];
          session(['userID' => $user_id]);
        // view
        // rediréger vers accueil une fois user est connecté 
          return redirect()->intended('/');

        }
        // afficher un erreur 
        return back()->withErrors([
          'username' => 'The provided credentials do not match our records.',
        ]);
    }

    public function signin(Request $request) 
    {
        // controller 
        // vérifier la saisie des infos 
        $validated = $request->validate([
          "username" => "required",
          "password" => "required",
          "password_confirmation" => "required|same:password"
        ]);
        // model
        // inserir les infos dans la base de données en hashant le mot de passe 
        $user = new User();
        $user->username = $validated["username"];
        $user->password = Hash::make($validated["password"]);
        $user->save();
        // commencer la session 
        Auth::login($user);
        // view
        // redériger vers accueil 
        return redirect('/');
    }
    
    public  function logout (Request $request) 
    {
        // controller
        // se déconnecter de l'application et redériger vers accueil 
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        // view
        return redirect('/');
    }
}