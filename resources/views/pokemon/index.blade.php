
@extends('../layout')
@section('content')
        <div class="row justify-content-center">
            @foreach($types as $type)
                <button class="btn-sm btn-outline-dark" id="type" value="{{$type->name}}">{{$type->name}}</button>
            @endforeach
            @foreach($pokemon as $poke)
                <?php
                    $pokemonSprites = JSON_DECODE($poke->sprites);
                    $pokemonAbilities = JSON_DECODE($poke->abilities);
                    $pokemonStats = JSON_DECODE($poke->stats);
                ?>
                <div class="card" style="width: 18rem; margin:10px;">
                    <a class="mx-auto" href="pokemon/{{$poke->id}}"><img src="{{$pokemonSprites->front_default}}"/></a>
                    <div class="card-body">
                        <h5 class="card-title text-center">#{{$poke->pokedex_number}} <?= ucwords($poke->name)?></h5>
                        <p class="card-text text-center">Height: {{$poke->height}} - Weight: {{$poke->weight}}
                            <br>
                            @foreach($pokemonAbilities as $ability)
                                <?= ucwords($ability->ability->name)?>
                            @endforeach
                        </p>
                        <p class="card-text text-center">
                            @foreach($pokemonStats as $stat)
                                <?= ucwords($stat->stat->name)?> - Base Stat: <?= ucwords($stat->base_stat)?></br>
                            @endforeach
                        </p>
                        <a href="pokemon/{{$poke->id}}" class="btn btn-outline-success mx-auto">View</a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row justify-content-center">
                    {!! $pokemon->links() !!}
        </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $("button").click(function(e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    "_token": "{{ csrf_token() }}",
                    type: "GET",
                    url: "/filter",
                    data: {
                        name: $('#type').val(),
                    },
                    success: function(result) {
                        alert('ok');
                    },
                    error: function(result) {
                        alert('error');
                    }
                });
            });
        });
    </script>
@endsection
