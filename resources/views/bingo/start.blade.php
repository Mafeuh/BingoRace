@extends('layouts.app')

@section('content')
    <div class="h-full">
        <h1 class="text-3xl text-center font-bold -m-5">Nouvelle partie !</h1>

        <h2 class="text-center text-xl my-8">Choisis les jeux que tu veux utiliser dans ta partie de Bingo !</h2>

        <form action="/start/post" method="POST">
            <div class="grid grid-cols-2">
                <div class="bg-green-100 mr-5 rounded-3xl">
                    <h1 class="text-center text-xl my-3">Jeux Publics</h1>
                    @if (sizeof($public_games) == 0)
                        <div class="text-center">Hm c'est pas normal ça. Normalement y'a plein de trucs ici et tout. Hm.</div>
                    @else
                        @foreach ($public_games as $game_it)
                            <div>
                                <input type="checkbox" name="selected_games[]" id="game_{{$game_it->id}}">
                                <label for="game_{{$game_it->id}}">{{$game_it->name}}</label>
                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="bg-green-100 ml-5 rounded-3xl">
                    <h1 class="text-center text-xl my-3">Tes Jeux</h1>

                    @if (sizeof($user_games) == 0)
                        <div class="text-center">Tu n'as pas encore importé tes propres jeux !</div>
                    @else
                        @foreach ($user_games as $game_it)
                            <div>{{$game_it}}</div>
                        @endforeach
                    @endif
                </div>
            </div>
        </form>
    </div>
    @endsection
