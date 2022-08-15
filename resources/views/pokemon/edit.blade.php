
@extends('../layout')
@section
    <div class="row justify-content-center">
        <?php

        $pokemonSprites = JSON_DECODE($pokemon->sprites);
        $pokemonAbilities = JSON_DECODE($pokemon->abilities);
        $pokemonMoves = JSON_DECODE($pokemon->moves);
        $pokemonStats = JSON_DECODE($pokemon->stats);
        ?>
        <table style="border: 1px solid;">
            <thead style="border: 1px solid;">
            <td style="border: 1px solid;"></td>
            <td style="border: 1px solid;">Pokedex Number</td>
            <td style="border: 1px solid;">Name</td>
            <td style="border: 1px solid;">Height</td>
            <td style="border: 1px solid;">Weight</td>
            <td style="border: 1px solid;">Abilities</td>
            <td style="border: 1px solid;">Stats</td>
            <td style="border: 1px solid;">Type</td>
            </thead>
            <tr style="border: 1px solid;">
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
                <td style="border: 1px solid;">
                    <a href="pokemon/{{$pokemon->id}}">Edit</a>
                </td>
                <td style="border: 1px solid;">
                    <a href="pokemon/{{$pokemon->id}}">Delete</a>
                </td>
            </tr>
            <tr>
                <td>
                    @foreach($pokemonMoves as $move)
                    <?= ucwords($move->move->name) ?></br>
                    @endforeach
                </td>
            </tr>
        </table>
@endsection
