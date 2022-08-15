
@extends('../layout')
@section('content')
    <div class="row justify-content-center">
        <?php

        $pokemonSprites = JSON_DECODE($pokemon->sprites);
        $pokemonAbilities = JSON_DECODE($pokemon->abilities);
        $pokemonMoves = JSON_DECODE($pokemon->moves);
        $pokemonStats = JSON_DECODE($pokemon->stats);
        ?>

        <table style="border: 1px solid;">
            <thead style="border: 1px solid;">
                <td style="border: 1px solid; text-align:center"></td>
                <td style="border: 1px solid; text-align:center">Pokedex Number</td>
                <td style="border: 1px solid; text-align:center">Name</td>
                <td style="border: 1px solid; text-align:center">Height</td>
                <td style="border: 1px solid; text-align:center">Weight</td>
                <td style="border: 1px solid; text-align:center">Abilities</td>
                <td style="border: 1px solid; text-align:center">Stats</td>
                <td></td>
            </thead>
                <tr style="border: 1px solid; text-align:center">
                    <td style="border: 1px solid;"><img src="{{$pokemonSprites->front_default}}" /></td>
                    <td style="border: 1px solid;">{{$pokemon->pokedex_number}}</td>
                    <td style="border: 1px solid;"><?= ucwords($pokemon->name)?></td>
                    <td style="border: 1px solid;">{{$pokemon->height}}</td>
                    <td style="border: 1px solid;">{{$pokemon->weight}}</td>
                    <td style="border: 1px solid;">
                        @foreach($pokemonAbilities as $ability)
                        <?= ucwords($ability->ability->name)?> </br>
                        @endforeach
                    </td>
                    <td style="border: 1px solid;">
                        @foreach($pokemonStats as $stat)
                            <?= ucwords($stat->stat->name)?> - Base Stat: <?= ucwords($stat->base_stat)?></br>
                        @endforeach
                    </td>
                    <td>
                        <a href="/pokemon" class="btn btn-outline-success">Back</a>
                    </td>
                    <td>
                        <a href="edit/{{$pokemon->id}}" class="btn btn-outline-success">Edit</a>
                    </td>
                    <td>
                        <a href="delete/{{$pokemon->id}}" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
                <tr style="border: 1px solid; text-align:center">
                    <td style="text-align:center">Move List</td>
                </tr>
                <tr style="border: 1px solid; text-align:center">
                    <td>
                        @foreach($pokemonMoves as $move)
                            <?= ucwords($move->move->name) ?></br>
                        @endforeach
                    </td>
                </tr>
        </table>
    </div>
    @endsection
