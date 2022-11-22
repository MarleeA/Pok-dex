<?php

use App\Http\Controllers\PokemonController;
use Illuminate\Support\Facades\Route;

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


Route::get('/pokemons', [PokemonController::class, 'index']);
Route::get('/pokemons/create', [PokemonController::class, 'create']);
Route::post('/pokemons', [PokemonController::class, 'store']);
Route::get('/pokemons/{pokemon}', [PokemonController::class, 'show']);
Route::get('/pokemons/{pokemon}/edit', [PokemonController::class, 'edit']);
Route::put('/pokemons/{pokemon}', [PokemonController::class, 'update']);
Route::delete('/pokemons/{pokemon}', [PokemonController::class, 'destroy']);;

Route::get('/', function () {
    return view('welcome');
});
