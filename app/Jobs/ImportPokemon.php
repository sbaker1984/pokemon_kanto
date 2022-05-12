<?php

namespace App\Jobs;

use App\Models\Pokemon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class ImportPokemon implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(){

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
