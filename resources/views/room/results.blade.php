@extends('layouts.app')

@section('content')

@php
$first_place = $ordered_teams->where('rank', 1); 
$second_place = $ordered_teams->where('rank', 2);
$third_place = $ordered_teams->where('rank', 3);

@endphp


<h1 class="text-3xl text-center font-bold -mt-5">
    {{ __('room.results.title') }} <button class="bg-emerald-500 text-lg p-2 rounded-full" onclick="show_details()">{{ __('room.results.details.show') }}</button>
</h1>
@if ($room->teams->count() == 0)
    <div class="text-center">
        {{ __('room.results.empty_teams') }}
    </div>
@endif


<div class="w-full left-0 bottom-0 h-full items-end">
    <div class="flex justify-center items-end bottom-0 w-full h-full">
        
        <div class="w-1/3 md:w-1/4 xl:w-1/6 h-full items-end flex flex-col">
            <div class="flex-grow"></div>
            
            <div class="text-center w-full grid p-1 gap-1">
                @foreach ($second_place as $team_it)
                <div class="shadow-xl rounded p-1 bg-[{{ $team_it->color }}]">
                    {{ __('room.results.points_amount', [
                        'points' => sizeof($team_it->checked_objectives),
                        'team_name' => $team_it->name
                    ]) }}
                </div>
                @endforeach
            </div>
            <div class="bg-emerald-700 rounded-t-xl h-2/5 w-full relative">
                <div class="text-center mt-5">
                    <div class="text-5xl">🥈</div>
                    <div class="text-2xl font-bold text-white">
                        {{ __('room.results.second_place') }}
                    </div>
                </div>
            </div>
        </div>
        
        <div class="w-1/3 md:w-1/4 xl:w-1/6 h-full items-end flex flex-col">
            <div class="flex-grow"></div>
            
            <div class="text-center w-full grid p-1 gap-1">
                @foreach ($first_place as $team_it)
                <div class="shadow-xl rounded p-1 bg-[{{ $team_it->color }}]"">
                    {{ __('room.results.points_amount', [
                        'points' => sizeof($team_it->checked_objectives),
                        'team_name' => $team_it->name
                    ]) }}
                </div>
                @endforeach
            </div>
            <div class="bg-emerald-600 rounded-t-xl h-3/5 w-full relative">
                <div class="text-center mt-5">
                    <div class="text-5xl">🥇</div>
                    <div class="text-2xl font-bold text-white">
                         {{ __('room.results.first_place') }}
                    </div>
                </div>
            </div>
        </div>
        
        <div class="w-1/3 md:w-1/4 xl:w-1/6 h-full items-end flex flex-col">
            <div class="flex-grow"></div>
            
            <div class="text-center w-full grid p-1 gap-1">
                @foreach ($third_place as $team_it)
                <div class="shadow-xl rounded p-1 bg-[{{ $team_it->color }}]">
                    {{ __('room.results.points_amount', [
                        'points' => sizeof($team_it->checked_objectives),
                        'team_name' => $team_it->name
                    ]) }}
                </div>
                @endforeach
            </div>
            <div class="bg-emerald-500 rounded-t-xl h-1/5 w-full relative">
                <div class="text-center mt-5">
                    <div class="text-5xl">🥉</div>
                    <div class="text-2xl font-bold text-white">
                        {{ __('room.results.third_place') }}
                    </div>
                </div>
            </div>
        </div>
    </div>    
</div>

<div class="hidden absolute left-0 top-0 w-full h-full bg-black/90 p-2" id="details">
    <h2 class="text-white text-center font-bold text-3xl">
        {{ __('room.results.details.title') }}
        <button class="text-lg bg-emerald-500 p-2 rounded-full text-black" onclick="hide_details()">
            {{ __('room.results.details.hide') }}
        </button>
    </h2>
    @if ($room->teams->count() == 0)
        <div class="text-center text-white">
            {{ __('room.results.empty_teams') }}
        </div>
    @endif
    <div class="flex justify-center mt-5 overflow-y-auto max-h-[70vh]">
        <div class="w-full md:w-4/5 xl:w-2/3">
            @for ($i = 0; $i < sizeof($ordered_teams); $i++)
                @php $team_it = $ordered_teams[$i]; @endphp
                <div class="p-2 rounded-xl border-4 m-2 border-[{{$team_it->color}}]">
                    <h2 class="font-bold text-[{{ $team_it->color }}]">
                        {{ $team_it->rank == 1 ? '🥇' : ($team_it->rank == 2 ? '🥈' : ($team_it->rank == 3 ? '🥉' : $team_it->rank . '.')) }}

                        {{ __('room.results.details.points_amount', ['team_name' => $team_it->name, 'points' => sizeof($team_it->checked_objectives)]) }}
                    </h2>
                    @foreach ($team_it->checked_objectives as $objective)
                        <div class="text-white">
                            <span class="font-bold">{{ $objective->objective->game->name }} -</span>
                            {{ $objective->objective->description }}
                        </div>
                    @endforeach
                </div>
            @endfor
        </div>
    </div>
</div>

<script>
    const details = document.getElementById('details');

    function show_details() {
        details.classList.remove('hidden');
    }

    function hide_details() {
        details.classList.add('hidden');
    }
</script>

@endsection