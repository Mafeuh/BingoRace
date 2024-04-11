@extends('layouts.app')

@section('content')

<div>
    <h1 class="text-3xl">Liste des jeux</h1>
    <hr>
    <h2 class="text-xl">Jeux publics</h2>
    <div class="flex flex-col">
        @foreach ($public_games as $game_it)
            <a href="/games/{{$game_it->id}}">{{ $game_it->name}}</a>
        @endforeach
    </div>

    <h2 class=text-xl>Jeux personnels</h2>
    <div class="flex flex-col">
        @foreach ($user_games as $game_it)
            <a href="/games/{{$game_it->id}}">{{ $game_it->name}}</a>
        @endforeach
    </div>
</div>
@endsection
