@extends('layouts.app')

@section('content')

<div>
    <h1 class="text-3xl">Liste des jeux</h1>
    <hr>
    <h2 class="text-xl">Jeux publics</h2>
    @foreach ($public_games as $game_it)
        <p>{{ $game_it->name}}</p>
    @endforeach

    <h2 class=text-xl>Jeux personnels</h2>
    @foreach ($user_games as $game_it)
        <p>{{ $game_it->name}}</p>
    @endforeach
</div>
@endsection
