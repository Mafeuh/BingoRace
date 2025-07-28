@extends('layouts.app')

@section('content')
    <h1 class="text-3xl text-center font-bold -mt-5">
        {{ __('room.setup.title') }}
    </h1>

    <form action="/room/setup" method="POST">
        @csrf
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-5 mt-5">
            <div class="bg-white overflow-scroll rounded-lg p-5 text-center">
                <span class="text-xl font-bold">
                    {{ __('room.setup.games') }}
                </span>
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-1 pt-5">
                    @foreach ($games as $game_it)
                    <div class="bg-gray-200 py-2 rounded-xl relative" style="padding-top: 100%; background-position:center; background-size:cover; background-repeat: no-repeat; background-image: url({{ asset($game_it->image_url) }});">
                        <div class="absolute transition-all inset-0 w-full h-full bg-white/50 hover:bg-white/80 rounded-xl flex justify-center items-center">
                            <div class="text-center bg-white/50 p-1 rounded shadow-xl">
                                <p class="text-xl">{{ $game_it->name }}</p>
                                <p class="text-xs">
                                    {{ __('room.setup.game.public_objectives.label', ['amount' => sizeof($game_it->public_objectives) ])}}
                                </p>
                                <p class="text-xs">
                                    {{ __('room.setup.game.private_objectives.label', ['amount' => sizeof($game_it->private_objectives) ])}}
                                </p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="lg:col-span-2 bg-white rounded-lg p-5 text-center">
                <span class="text-xl font-bold">
                    {{ __('room.setup.settings.title') }}
                </span>
                <x-room-creation-settings></x-room-creation-settings>

                <hr class="my-5"/>

                <div class="space-y-2">
                    <h2 class="text-xl font-bold">
                        {{ __('room.setup.objectives_pool.title') }}
                    </h2>

                    
                </div>
            </div>
        </div>
        <div class="text-center pt-5">
            <input type="hidden" name="room_id" value="{{ $room->id }}">
            <x-form.submit-input>
                <span class="font-bold">
                    {{ __('room.setup.submit') }}
                </span>
            </x-form.submit-input>
        </div>
    </form>
@endsection
