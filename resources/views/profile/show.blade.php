@extends('layouts.app')

@section('content')

<div class="bg-white/90 p-2 rounded-lg">
    @if ($private_lock)
        <div class="text-center text-red-600 font-bold text-xl my-12">
            Ce profil est privé. 🔒
        </div>
    @else

        <h1 class="text-emerald-800 text-xl font-bold text-center">
            @if ($user == auth()->user())
                {{ __('profile.title.you') }}
            @else
                {{ __('profile.title.not_you', ['name' => $user->name]) }}
            @endif
        </h1>

        <div class="grid grid-cols-3 divide-x-2 divide-emerald-200">
            <div class="p-1">
                <h2 class="text-center text-emerald-700 font-bold">
                    @if ($user == auth()->user())
                        {{ __('profile.games.title.you', ['amount' => sizeof($user->created_games)]) }}
                    @else
                        {{ __('profile.games.title.not_you', ['name' => $user->name, 'amount' => sizeof($user->created_games)]) }}
                    @endif
                </h2>
                <div class="grid grid-cols-3 p-2 gap-1">
                    @foreach ($games as $game)
                        <x-game-card :game="$game" :show_objectives="true" :show_favorite_star="false"/>
                    @endforeach
                </div>
            </div>
            <div class="p-1">
                <h2 class="text-center text-emerald-700 font-bold">
                    @if ($user == auth()->user())
                        {{ __('profile.participations.title.you') }}
                    @else
                        {{ __('profile.participations.title.not_you', ['name' => $user->name]) }}
                    @endif            
                </h2>
                <div class="italic text-center text-sm">
                    {{ __('profile.participations.details') }}
                </div>
                <div class="grid grid-cols-3 gap-0.5">
                    @foreach ($participations as $participation)
                        @php $team = $participation->participant?->team  @endphp
                        @if ($team)
                            <livewire:profile-team-card :team="$team"/>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    @endif
</div>

@endsection