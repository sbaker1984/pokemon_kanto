<?php

namespace App\Http\Controllers;

use App\Models\Pokemon;
use App\Models\Types;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TypesController extends Controller{

    public function filterByType(Request $request){
        $pokemon = Pokemon::get();
        $pokemonTypes = [];
        foreach($pokemon as $poke) {
            $pokemonTypes[] = JSON_DECODE($poke->types);
        }

        $typeArray = [];
        foreach($pokemonTypes as $type){
            foreach($type as $newtype){
                $typeArray[] = [$newtype->type->name];
            }
        }

        $pokemonFiltered = Pokemon::whereIn('types', $typeArray)->paginate(20);
        $types = Types::all();
        return View('pokemon.index')->with('pokemon', $pokemonFiltered)->with('types', $types);
    }

    public function getTypes(){

        $types = JSON_DECODE(Http::get('https://pokeapi.co/api/v2/type'));
        $data = [];
        foreach($types->results as $type){
            $data[] = [
                'name' => $type->name
            ];
        }

        foreach($data as $type){
            if(Types::where('name', $type['name'])->exists()){
                return redirect('/pokemon');
            } else {
                Types::create(array(
                    'name' => $type['name'],
                    'weak_against' => 'null',
                    'strong_against' => 'null',
                ));
            }
        }
        return redirect('/pokemon');

    }
}
