@extends('layouts.app')

@section('content')
    <div class="bg-white h-full p-2 rounded-xl shadow-lg">
        <h1 class="text-center text-2xl font-bold text-red-900">Zone administrateur</h1>

        <div class="grid xl:grid-cols-3 h-fit gap-2">
            <form action="{{ route('admin.join_room') }}" method="POST">
                @csrf
                <div class="bg-gray-100 p-4">
                    <h1 class="text-center text-xl">Historique des parties lancées</h1>
    
                    <div class="grid grid-cols-5 gap-x-2 select-none" x-data="{ hide_codes: true }">
                        <div class="font-bold text-center">Numéro de la salle</div>
                        <div x-on:click="hide_codes = !hide_codes" class="font-bold text-center">Code de la salle <span x-show="!hide_codes">😐</span><span x-show="hide_codes">😑</span></div>
                        <div class="font-bold col-span-2 text-center">Jeux</div>
                        <div class="font-bold text-center">Créée par</div>
                        @forelse ($rooms as $room)
                            <div class="my-1 relative">
                                <button class="p-1 bg-gray-300 rounded-full" type="submit" name="confirm" value="{{$room->id}}">Salle N°{{ $room->id }}</button>
                            </div>
                            <div x-show="hide_codes" class="text-center">Code caché</div>
                            <div x-show="!hide_codes" class="text-center">{{ $room->code }}</div>
                            <div class="col-span-2 text-center">
                                @forelse ($room->games as $game)
                                    <a href="/games/{{$game->id}}" class="p-2 bg-green-100">{{ $game->name }}</a>
                                @empty
                                    <p>Pas de jeu</p>
                                @endforelse
                            </div>
                            <div>
                                {{ \App\Models\User::find($room->creator_id)->name }}
                            </div>
                        @empty
                            <h2>Aucune partie à afficher.</h2>
                        @endforelse
                    </div>
    
    
                    <div>
                        {{ $rooms->links() }}
                    </div>
                </div>
            </form>

            <div class="bg-gray-100 p-4 col-span-2">
                <h1 class="text-xl text-center mb-10">Gérer les permissions</h1>

                <livewire:user-permission-editor/>
            </div>

            <div class="bg-gray-100 p-4">
                <h1 class="text-xl text-center mb-10">Paramètres de l'application</h1>
    
                <livewire:app-settings-form/>
            </div>
        </div>
    </div>
@endsection