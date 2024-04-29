@extends('layouts.app')

@section('content')

<div>
    <h1 class="text-3xl text-center">Liste des jeux</h1>

    <div class="grid grid-cols-2 gap-x-10">
        <div class="bg-green-100 rounded-3xl p-5 font-bold">
            <h2 class="text-xl text-center">Jeux publics</h2>
            <div class="grid grid-cols-3 gap-5 mt-5">
                @foreach ($public_games as $game_it)
                    <a href="/games/{{$game_it->id}}">
                        <x-game-card :game="$game_it"/>
                    </a>
                @endforeach
            </div>
        </div>

        <div class="bg-green-100 rounded-3xl p-5 font-bold">
            <h2 class="text-xl text-center">Jeux personnels</h2>
            <div class="grid grid-cols-3 gap-5 mt-5">
                @foreach ($user_games as $game_it)
                    <a href="/games/{{$game_it->id}}">
                        <x-game-card :game="$game_it"/>
                    </a>
                @endforeach
            </div>

            <div class="text-center hover:scale-125 transition-all">
                <a href="/games/new" class="bg-green-300 hover:bg-green-500 font-thin hover:font-bold px-5 py-2 rounded-xl">Créer un nouveau jeu</a>
            </div>
        </div>
    </div>


</div>
@endsection
