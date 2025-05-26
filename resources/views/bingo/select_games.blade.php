@extends('layouts.app')

@section('content')
    <div class="h-full">
        <h1 class="text-3xl text-center font-bold -m-5">Nouvelle partie !</h1>

        <h2 class="text-center text-xl my-8">Choisis les jeux que tu veux utiliser dans ta partie de Bingo !</h2>

        <form action="/start" method="POST">
            @csrf
            <div class="grid grid-cols-2">
                <div class="bg-green-100 mr-5 rounded-3xl p-5">
                    <p class="text-center font-bold text-xl">Jeux Publics</p>
                    @if (sizeof($public_games) == 0)
                        <div class="text-center">Hm c'est pas normal ça. Normalement y'a plein de trucs ici et tout. Hm.</div>
                    @else
                    <div class="space-y-5 pb-5">
                        @foreach ($public_games as $game_it)
                            <x-game-checkbox :game="$game_it"></x-game-checkbox>
                        @endforeach
                    </div>
                    @endif
                </div>
                <div class="bg-green-100 ml-5 rounded-3xl p-5">
                    <p class="text-center font-bold text-xl">Tes Jeux</p>

                    @if (sizeof($user_games) == 0)
                        <div class="text-center">Tu n'as pas encore importé tes propres jeux !</div>
                    @else
                        @foreach ($user_games as $game_it)
                            <div>{{$game_it}}</div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="text-center mt-5">
                <x-form-validation>Commencer une partie !</x-form-validation>
            </div>
        </form>
        @isset($error)
            <div>{{ $error }}</div>
        @endisset
    </div>
    @endsection
