@extends('layouts.app')

@section('page_title')
    Zone administrateur
@endsection

@section('content')
    <x-main-panel class="grid lg:grid-cols-2 2xl:grid-cols-3 h-fit gap-2">
        <x-secondary_panel title="Historique des parties lancées">
            <form action="{{ route('admin.join_room') }}" method="POST">
                @csrf

                <div class="grid grid-cols-5 gap-x-2 select-none" x-data="{ hide_codes: true }">
                    <div class="font-bold text-center">Numéro de la salle</div>
                    <div x-on:click="hide_codes = !hide_codes" class="font-bold text-center">Code de la salle <span x-show="!hide_codes">😐</span><span x-show="hide_codes">😑</span></div>
                    <div class="font-bold col-span-2 text-center">Jeux</div>
                    <div class="font-bold text-center">Créée par</div>
                    @forelse ($rooms as $room)
                        <div class="my-1 relative">
                            <button class="p-1 bg-gray-300 dark:bg-slate-800 rounded-full" type="submit" name="confirm" value="{{$room->id}}">Salle N°{{ $room->id }}</button>
                        </div>
                        <div x-show="hide_codes" class="text-center">Code caché</div>
                        <div x-show="!hide_codes" class="text-center">{{ $room->code }}</div>
                        <div class="col-span-2">
                            @forelse ($room->games as $game)
                                <a href="/games/{{$game->id}}" class="p-2 bg-blue-200 dark:bg-slate-800 rounded">{{ $game->name }}</a>
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
            </form>
        </x-secondary_panel>


        <x-secondary_panel title="Gérer les permissions">
            <livewire:user-permission-editor/>
        </x-secondary_panel>

        <x-secondary_panel title="Paramètres">    
            <livewire:app-settings-form/>
        </x-secondary_panel>
    </x-main-panel>
@endsection