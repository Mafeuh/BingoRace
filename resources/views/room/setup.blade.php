@extends('layouts.app')

@section('content')
    <h1 class="text-3xl text-center font-bold -mt-5">Préparation de la partie</h1>

    <form action="/room/setup" method="POST">
        <div class="grid grid-cols-3 space-x-5 mt-5">
            <div class="bg-green-100 overflow-scroll p-5 text-center">
                <span class="text-xl font-bold">Rappel des jeux</span>
                <div class="grid grid-cols-3 space-x-2 pt-5">
                    @foreach ($games as $game_it)
                    <div class="bg-white py-2 rounded-xl relative" style="padding-top: 100%; background-position:center; background-size:cover; background-repeat: no-repeat; background-image: url({{ asset($game_it->image_url) }});">
                        <div class="absolute transition-all inset-0 w-full h-full bg-white/50 hover:bg-white/80 rounded-xl flex justify-center items-center">
                            <div class="text-center bg-white/50 p-1 rounded shadow-xl">
                                <p class="text-xl">{{ $game_it->name }}</p>
                                <p class="text-xs">{{ sizeof($game_it->public_objectives) }} objectifs publics</p>
                                <p class="text-xs">{{ sizeof($game_it->private_objectives) }} objectifs privés</p>
                            </div>
                        </div>
                        
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
            <input type="hidden" name="room_id" value="{{ $room->id }}">
            <x-form-validation><span class="font-bold">Créer la salle !</span></x-form-validation>
        </div>
    </form>
@endsection
