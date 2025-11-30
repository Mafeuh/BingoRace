@extends('layouts.app')

@section('page_title') {{ __('room.results.title') }} @endsection

@section('content')

@php
$first_place = $ordered_teams->where('rank', 1); 
$second_place = $ordered_teams->where('rank', 2);
$third_place = $ordered_teams->where('rank', 3);

@endphp

<h1 class="text-3xl text-center font-bold">
        <x-form.button onclick="show_details()">{{ __('room.results.details.show') }}</x-form.button>
</h1>
@if ($room->teams->count() == 0)
    <div class="text-center">
        {{ __('room.results.empty_teams') }}
    </div>
@endif

<div class="absolute text-center w-full bottom-0">
    <div class="flex items-end justify-center">
        <div>
            @foreach ($second_place as $team)
                <div class="rounded p-1 border-2 bg-[{{ $team->color }}]/50 border-[{{ $team->color }}]">
                    {{ __('room.results.points_amount', [
                        'points' => sizeof($team->checked_objectives),
                        'team_name' => $team->name
                    ]) }}
                </div>
            @endforeach
            <div class="mt-2 bg-blue-400 dark:bg-red-950 w-80 border-blue-500 dark:border-red-500
                border-t border-x h-60 rounded-tl-lg shadow shadow-red-500"></div>
        </div>
        <div>
            @foreach ($first_place as $team)
                <div class="rounded p-1 border-2 bg-[{{ $team->color }}]/50 border-[{{ $team->color }}]">
                    {{ __('room.results.points_amount', [
                        'points' => sizeof($team->checked_objectives),
                        'team_name' => $team->name
                    ]) }}
                </div>
            @endforeach
            <div class="mt-2 bg-violet-400 dark:bg-violet-950 border-violet-500
                border-t border-x w-80 h-96 rounded-t-lg shadow shadow-violet-500"></div>
        </div>

        <div>
            @foreach ($third_place as $team)
                <div class="rounded p-1 border-2 bg-[{{ $team->color }}]/50 border-[{{ $team->color }}]">
                    {{ __('room.results.points_amount', [
                        'points' => sizeof($team->checked_objectives),
                        'team_name' => $team->name
                    ]) }}
                </div>
            @endforeach
            <div class="mt-2 bg-red-400 dark:bg-blue-950 w-80 border-red-500 dark:border-blue-500
                border-t border-x h-32 rounded-tr-lg shadow shadow-blue-500"></div>
        </div>
    </div>
    <div class="flex justify-center">
        <div class="w-80 bg-gradient-to-t from-transparent to-blue-400 dark:to-red-950 h-12"></div>
        <div class="w-80 bg-gradient-to-t from-transparent to-violet-400 dark:to-violet-950 h-12"></div>
        <div class="w-80 bg-gradient-to-t from-transparent to-red-400 dark:to-blue-950 h-12"></div>
    </div>
</div>

<div class="hidden absolute left-0 top-0 w-full h-full bg-black/90 p-2" id="details">
    <h2 class="text-white text-center font-bold text-3xl">
        {{ __('room.results.details.title') }}
        <x-form.button onclick="hide_details()">
            {{ __('room.results.details.hide') }}
        </x-form.button>
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