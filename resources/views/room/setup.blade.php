@extends('layouts.app')

@section('content')
    <h1 class="text-3xl text-center">Préparation de la partie</h1>
    <h2 class="text-center">Code de la salle:
        <span x-data="{ hidden: true }" x-on:click="hidden = !hidden">
            <span x-show="hidden" class="bg-gray-700 text-white rounded-md">Clique pour révéler !</span>
            <span x-show="!hidden">{{ $room->code }}</span>
        </span>
    </h2>

    <form action="/room/setup" method="POST">
        <div class="grid grid-cols-3 space-x-5 mt-5">
            <div class="bg-green-100 overflow-scroll p-5 text-center">
                <span class="text-xl font-bold">Rappel des jeux</span>
                <div class="grid grid-cols-3 space-x-2 pt-5">
                    @foreach ($games as $game_it)
                    <div class="border-2 py-2 rounded-xl">
                        <p>{{ $game_it->name }}</p>
                        <p class="text-xs">{{ sizeof($game_it->public_objectives) }} objectifs publics</p>
                        <p class="text-xs">{{ sizeof($game_it->user_objectives) }} objectifs privés</p>
                    </div>
                    @endforeach
                </div>
            </div>
        @csrf

            <div class="col-span-2 bg-green-100 p-5 text-center">
                <span class="text-xl font-bold">Paramètres</span>
                <x-room-creation-settings></x-room-creation-settings>
            </div>

        </div>
        <div class="text-center pt-5">
            <x-form-validation><span class="font-bold">Créer la salle !</span></x-form-validation>
        </div>
    </form>
@endsection
