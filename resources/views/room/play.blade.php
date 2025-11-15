@extends('layouts.app')

@section('content')
<div class="relative">
    <livewire:team-scores :room="$room"/>

    @if ($cache_hide_time - $server_time > 0)
        <div id="cache" class="bg-green-300 absolute w-full h-full z-10 transition-all duration-100 flex flex-col place-content-center items-center rounded-3xl">
            <div class="text-center space-y-5">
                <h1 class="text-4xl lg:text-8xl text-white font-bold">
                    {{ __('room.play.starting_cache.title') }}
                </h1>
                <h2 class="lg:text-4xl text-white">
                    {{ __('room.play.starting_cache.description') }} <span id="cache_timer"></span>
                </h2>
            </div>

            <div id="countdown" class="text-2xl font-bold text-red-600"></div>
            <script>
                const ends_at_unix_s = {{ $ends_at }};

                function updateCountdown() {
                    const now = Date.now().getTime() / 1000;
                    const remaining = ends_at_unix_s - now;

                    if (remaining <= 0) {
                        clearInterval(interval);
                        document.getElementById("cache").classList.add('opacity-0');
                        document.getElementById("cache").classList.remove('z-10');
                        document.getElementById("grid").classList.remove('opacity-0');
                        return;
                    }

                    const seconds = Math.floor((remaining / 1000) % 60);
                    const minutes = Math.floor((remaining / 1000 / 60) % 60);
                    const hours = Math.floor((remaining / 1000 / 60 / 60));

                    document.getElementById("cache_timer").textContent = 
                        `${String(seconds).padStart(2, '0')}`;
                }

                updateCountdown();
                const interval = setInterval(updateCountdown, 1000);
            </script>
        </div>
    @endif

    @php
        $team = \App\Models\Team::findMany(
            auth()->user()->participations->pluck('participant.team_id')
            )->where('room_id', $room->id)->first();
            
        $teams = $room->teams;
    @endphp

    <div id="grid" @class(["relative justify-center flex-0 flex my-2", 'opacity-0' => $cache_hide_time - $server_time > 0]) >
        <livewire:bingo-grid :player_team_id="$team->id ?? -1" :room_id="$room->id"/>

        @if ($room->duration_seconds != null)
            <div id="victory_cache" class="bg-green-300/80 hidden absolute w-full h-full z-10 transition-all duration-100 flex flex-col place-content-center items-center rounded-3xl">
                <div class="text-center space-y-5">
                    <h1 class="text-4xl lg:text-8xl text-white font-bold">
                        {{ __('room.play.ending_cache.description') }}
                    </h1>
                    <a href="{{ route('room.results') }}" class="bg-emerald-500 p-4 inline-block mt-5">
                        {{ __('room.play.ending_cache.redirect_to_results') }}
                    </a>
                </div>
        
                <div id="countdown" class="text-2xl font-bold text-red-600"></div>
            </div>
        @endif
    </div>

    @if ($room->duration_seconds != null)
        <div class=" flex justify-center mb-1">
            <div id="timer" class="text-center justify-center">
                <x-room-timer :room="$room" :ends_at="$ends_at"/>
        
                <script>
                    window.addEventListener('timer_ended', function() {
                        document.getElementById('victory_cache').classList.remove('hidden');
                    });
                </script>
            </div>
        </div>
    @else
        <div class="text-center mb-5">
            <a href="{{ route('room.results') }}" class="bg-emerald-500 p-2 inline-block mt-5">
                {{ __('room.play.ending_cache.redirect_to_results') }}
            </a>
        </div>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const roomId = {{ $room->id }};
            const channelName = `room.${roomId}`;

            window.Echo.channel(channelName)
                .listen('.square-checked', (event) => {
                    Livewire.dispatch('square-checked', event);
                });
        });
    </script>
@endsection
