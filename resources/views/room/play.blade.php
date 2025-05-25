@extends('layouts.app')

@section('content')
<div>
    <div class="justify-center flex items-center">
        <x-bingo-grid :grid="$room->grid"></x-bingo-grid>
    </div>

    @php
        $team = \App\Models\Team::findMany(
            auth()->user()->participations->pluck('participant.team_id')
        )->where('room_id', $room->id)->first();

        $teams = $room->teams;
    @endphp
    
    <div class="text-center my-10 text-xl">
        Tu es dans l'équipe 
        <span class=" rounded-lg bg-[{{$team->color}}] px-3 py-2">{{ $team->name }}</span> !
    </div>

    @if (sizeof($teams) > 1)
        <div class="bg-white p-5 m-10">
            <div class="text-center font-bold mb-5">Les équipes</div>

            <div class="flex justify-center">
                @foreach ($room->teams as $team)
                <div class="bg-[{{$team->color}}] w-64 p-4">
                    <p class="text-center mb-4">Équipe <span class="font-bold">{{ $team->name }}</span></p>
                    @foreach ($team->participants as $member)
                        <p class="bg-white bg-opacity-50 p-1 text-center">
                            {{$member->participantable->user->name}}
                        </p>
                    @endforeach
                </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection
