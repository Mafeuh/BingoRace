@extends('layouts.app')

@section('content')
<div class="relative">
    @if ($cache_hide_time - $server_time > 0)
        <div id="cache" class="bg-green-300 absolute w-full h-full z-10 transition-all duration-100 flex flex-col place-content-center items-center rounded-3xl">
            <div class="text-center space-y-5">
                <h1 class="text-8xl text-white font-bold">Préparez-vous !</h1>
                <h2 class="text-4xl text-white">Ce cache disparait dans <span id="cache_timer"></span>s</h2>
            </div>

            <div id="countdown" class="text-2xl font-bold text-red-600"></div>
            <script>
                const deadline = {{ $cache_hide_time }} * 1000; // en ms
                const serverTime = {{ $server_time }} * 1000; // en ms
                const clientTime = Date.now();
                const offset = serverTime - clientTime; // décalage horloge client/serveur

                function updateCountdown() {
                    const now = Date.now() + offset;
                    const remaining = deadline - now;

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

    @if ($room->duration_seconds != null)
    <div class="-mt-8 flex justify-center mb-1">
        <div id="timer" class="text-center justify-center">
            <x-room-timer :room="$room"/>
    
            <script>
                window.addEventListener('timer_ended', function() {
                    document.getElementById('victory_cache').classList.remove('hidden');
                });
            </script>
        </div>
    </div>
    @endif

    <div id="grid" @class(["relative justify-center flex-0 flex", 'opacity-0' => $cache_hide_time - $server_time > 0]) >
        <x-bingo-grid :grid="$room->grid" :editable="isset($team)"></x-bingo-grid>

        @if ($room->duration_seconds != null)
            <div id="victory_cache" class="bg-green-300/70 hidden absolute w-full h-full z-10 transition-all duration-100 flex flex-col place-content-center items-center rounded-3xl">
                <div class="text-center space-y-5">
                    <h1 class="text-8xl text-white font-bold">Partie terminée !!</h1>
                </div>
        
                <div id="countdown" class="text-2xl font-bold text-red-600"></div>
            </div>
        @endif
    </div>
    
    @isset($team)
    <div class="text-center my-4">
        Tu es dans l'équipe 
        <span class=" rounded-lg bg-[{{$team->color}}] px-3 py-2">{{ $team->name }}</span> !
    </div>
    @else
    <div class="text-center my-4 text-xl">
        Tu es spectateur !
    </div>
    @endisset
    
    <livewire:team-scores :room="$room"/>
</div>
@endsection
