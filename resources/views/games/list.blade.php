@extends('layouts.app')

@section('content')

<div>
    <h1 class="text-3xl text-center font-bold -mt-5 mb-5">Liste des jeux</h1>
    <div class="text-center m-5">
        <a href="/games/new" class="bg-green-500 p-2 rounded-full hover:bg-green-700">Créer un jeu !</a>
    </div>

    <div class="grid grid-cols-2 gap-x-10">
        <div class="bg-white rounded-3xl p-5 font-bold">
            <h2 class="text-xl text-center">Jeux publics</h2>
            <div class="grid grid-cols-3 gap-5 mt-5">
                @foreach ($public_games as $game_it)
                    <a href="/games/{{$game_it->id}}">
                        <x-game-card :game="$game_it"/>
                    </a>
                @endforeach
            </div>
        </div>

        <div class="bg-white rounded-3xl p-5 font-bold">
            <h2 class="text-xl text-center">Jeux personnels</h2>
            <div class="grid grid-cols-3 gap-5 mt-5">
                @forelse ($user_games as $game_it)
                    <a href="/games/{{$game_it->id}}">
                        <x-game-card :game="$game_it"/>
                    </a>
                @empty
                <div class="text-center col-span-3">
                    Vous n'avez pas encore créé de jeu !
                </div>
                @endforelse
            </div>
        </div>
    </div>


</div>
@endsection
