@extends('layouts.app')

@section('content')
<div>
    <h1 class="text-3xl text-center">La partie est sur le point de commencer !</h1>
    <h2 class="text-2xl text-center">Code de la salle :
        <span x-data="{ hidden: true }" x-on:click="hidden = !hidden">
            <span x-show="hidden" class="bg-gray-700 text-white rounded-md">Clique pour révéler !</span>
            <span x-show="!hidden" class="font-bold">{{ $room->code }}</span>
        </span>
    </h2>

    <div class="grid grid-cols-3">
        <livewire:participants-list :room="$room" />
    </div>
</div>
@endsection
