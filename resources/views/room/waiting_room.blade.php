@extends('layouts.app')

@section('content')
<div class="h-fit">
    <div class="grid grid-cols-3 h-fit">
        <div class="bg-white p-3 shadow-inner shadow-green-100 rounded-3xl h-fit">
            <livewire:participants-list />
        </div>
        <div class="col-span-2">
            <h1 class="text-3xl text-center">La partie est sur le point de commencer !</h1>
            <h2 class="text-2xl text-center">Code de la salle :
                <span x-data="{ hidden: true }" x-on:click="hidden = !hidden">
                    <span x-show="hidden" class="bg-gray-700 text-white rounded-md">Clique pour révéler !</span>
                    <span x-show="!hidden" class="font-bold">{{ $room->code }}</span>
                </span>
            </h2>
        </div>
    </div>

</div>
@endsection
