@extends('layouts.app')

@section('content')

<div class="bg-white/90 p-2 rounded-lg">
    <h1 class="text-emerald-800 text-xl font-bold text-center">
        @if ($user == auth()->user())
            {{ __('profile.title.you') }}
        @else
            {{ __('profile.title.not_you', ['name' => $user->name]) }}
        @endif
    </h1>

    <div class="grid grid-cols-3">
        <div class="bg-gray-200 p-1 rounded-lg">
            <h2 class="text-center text-emerald-700 font-bold">
                @if ($user == auth()->user())
                    {{ __('profile.games.title.you', ['amount' => sizeof($user->created_games)]) }}
                @else
                    {{ __('profile.games.title.not_you', ['name' => $user->name, 'amount' => sizeof($user->created_games)]) }}
                @endif
            </h2>
            <div class="grid grid-cols-2 p-2 gap-1">
                @foreach ($user->created_games as $game)
                    <x-game-card :game="$game" :show_objectives="true" :show_favorite_star="false"/>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection