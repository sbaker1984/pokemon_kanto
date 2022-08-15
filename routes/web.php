<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\PokemonController;
use \App\Http\Controllers\TypesController;

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

Route::get('/', [PokemonController::class, 'index']);
Route::get('/getTypes', [TypesController::class, 'getTypes']);
Route::get('/getAbilities', [\App\Http\Controllers\abilitiesController::class, 'getAbilities']);
Route::GET('/filter', [TypesController::class, 'filterByType']);
Route::GET('/pokemon/edit/{id}', [PokemonController::class, 'edit']);
Route::GET('/pokemon/delete/{id}', [PokemonController::class, 'delete']);

Route::resource('pokemon', PokemonController::class);
