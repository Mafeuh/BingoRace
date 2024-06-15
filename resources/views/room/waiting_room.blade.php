@extends('layouts.app')

@section('content')
<div class="h-fit">
    <div class="grid grid-cols-3 h-fit">
        <div class="bg-white p-3 shadow-inner shadow-green-100 rounded-3xl h-fit">
            <livewire:participants-list />
        </div>
        <div class="col-span-2">
            <div>
                <h1 class="text-3xl text-center">La partie est sur le point de commencer !</h1>
                <h2 class="text-2xl text-center">Code de la salle :
                    <span x-data="{ hidden: true }" x-on:click="hidden = !hidden">
                        <span x-show="hidden" class="bg-gray-700 text-white rounded-md">Clique pour révéler !</span>
                        <span x-show="!hidden" class="font-bold">{{ $room->code }}</span>
                    </span>
                </h2>
            </div>

            <div class="bg-green-100 m-5 p-5 rounded-xl">
                <div class="font-bold text-green-500">Rappel des règles:</div>
                <div>
                    Une grille de  {{ $room->grid->height * $room->grid->width }} cases va apparaître. Chacune de ces cases va contenir un objectif à remplir.
                </div>
                <div>
                    Pour gagner, faites en sorte que votre équipe coche plus de case que les autres équipes. Pour cocher une case, il faut évidemment remplir l'objectif :).
                </div>
            </div>

            @if (auth()->user()->id == $room->creator_id)
                <div class="mt-10 text-center text-xl">
                    Une fois tous les participants présents, clique sur <span class="font-bold">Commencer</span> !
                </div>
                <div class="mt-5 text-center">
                    <a href="/room/start" class="text-xl bg-green-500 px-5 py-3 rounded-full font-bold hover:bg-green-700">Commencer !</a>
                </div>
            @endif
        </div>

    </div>
</div>
@endsection
