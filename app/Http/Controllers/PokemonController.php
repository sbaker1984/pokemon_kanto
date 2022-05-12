<?php

namespace App\Http\Controllers;

use App\Models\Pokemon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\View;

class PokemonController extends Controller
{
    public function index() {
        $pokemon = pokemon::all();
        return View('pokemon.index')->with('pokemon', $pokemon);
    }

    public function show($id) {
        $pokemon = pokemon::findorfail($id);
        return View('pokemon.pokemon')->with('pokemon', $pokemon);
    }

    public function edit($id) {
        $pokemon = pokemon::findorfail($id);
        return View('pokemon.edit')->with('pokemon', $pokemon);
    }

    public function update(Request $request, $id) {
        if (pokemon::where('id', $id)->exists()) {
            $pokemon = pokemon::find($id);
            $pokemon->name = is_null($request->name) ? $pokemon->name : $request->name;
            $pokemon->height = is_null($request->height) ? $pokemon->name : $request->height;
            $pokemon->weight= is_null($request->weight) ? $pokemon->name : $request->weight;
            $pokemon->abilities= is_null($request->abilities) ? $pokemon->name : $request->abilities;
            $pokemon->forms = is_null($request->forms) ? $pokemon->name : $request->forms;
            $pokemon->moves = is_null($request->moves) ? $pokemon->name : $request->moves;
            $pokemon->sprites = is_null($request->sprites) ? $pokemon->name : $request->sprites;
            $pokemon->species = is_null($request->species) ? $pokemon->name : $request->species;
            $pokemon->stats = is_null($request->stats) ? $pokemon->name : $request->stats;
            $pokemon->save();

            return response()->json([
                "message" => "Pokemon has been updated"
            ], 200);
        } else {
            return response()->json([
                "message" => "Not found"
            ], 404);

        }
    }

    public function delete($id) {
        $pokemon = pokemon::findorfail($id);
        $pokemon->delete();

        return redirect(pokemon);
    }


    public function getPokemon(){
        $pokemon = Http::get('https://pokeapi.co/api/v2/pokemon?limit=151');
        $kantoPokemon = JSON_DECODE($pokemon);
        $data = [];
        foreach($kantoPokemon->results as $items){
            $data[] = [
                'url' => $items->url
            ];
        }

        $pokemonDetails = [];
        foreach($data as $urls){
            $pokemonDetails[] = JSON_DECODE(Http::get($urls['url']));
        };

        foreach($pokemonDetails as $pokemons){
            pokemon::create(array(
                'pokedex_number' => $pokemons->id,
                'name' => $pokemons->name,
                'height' => $pokemons->height,
                'weight' => $pokemons->weight,
                'abilities' => json_encode($pokemons->abilities),
                'forms' => json_encode($pokemons->forms),
                'moves' => json_encode($pokemons->moves),
                'sprites' => json_encode($pokemons->sprites),
                'stats' => json_encode($pokemons->stats),
                'types' =>json_encode($pokemons->types)
            ));
        };
    }
}
