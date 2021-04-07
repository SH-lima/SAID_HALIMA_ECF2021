<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\AnimeController;
use  App\Http\Controllers\AuthController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [AnimeController::class, 'read']);

Route::get('/anime/{id}',[AnimeController::class, "read_anime"]);

Route::get('/anime/{id}/new_review', [AnimeController::class, 'new_review']);

Route::get('/login', function () {
  return view('login');
});

Route::post('/login', [AuthController::class, 'login']);

Route::post('/add_review', [AnimeController::class, 'add_review']);

Route::get('/signup', function () {
  return view('signup');
});

Route::post('signup', [AuthController::class, 'signin']);

Route::post('signout',[AuthController::class, 'logout']);

Route::get('/top', [AnimeController::class, 'top_animes']);

Route::post('/anime/{id}/add_to_watch_list', [AnimeController::class, 'add_to_watch_list']);

Route::get('/watchlist', [AnimeController::class, 'read_watchlist']);