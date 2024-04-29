@extends('layouts.app')

@section('content')
<div class="justify-center flex h-full">
    <form method="POST" action="/games/{{$game->id}}/objective" class="bg-green-50 px-40 py-10 rounded-3xl" name="blbblbblblb">
        @csrf
        <div class="mb-5">
            <h1 class="text-3xl text-center font-bold mb-5">Ajout d'un objectif pour {{ $game->name }}</h1>
            <div class="text-center">
                @if ($game->creator_id == auth()->user()->id)
                    Tu es administrateur pour la gestion de ce jeu. Tu peux décider de la visibilité de cet objectif.
                @else
                    Tu ne peux créer que des objectifs privés.
                @endif
            </div>
        </div>
        <div class="flex flex-col">
            {{-- <label for="description">Description</label> --}}
            <x-custom-text-input name="description" placeholder="Description de l'objectif"/>
            @error('description')
                <span class="text-red-500">{{ __($message) }}</span>
            @enderror
        </div>

        <div class="flex flex-col mt-5">
            <x-custom-select name="visibility">
                <option value="" disabled selected>Visibilité</option>
                @if (auth()->user()->id == $game->creator_id)
                    <option value="public">Publique</option>
                @endif
                <option value="private">Privé</option>
                <option value="team">Pour l'équipe</option>
            </x-custom-select>
            @error('visibility')
                <span class="text-red-500">{{ __($message) }}</span>
            @enderror
        </div>

        <div class="mt-5">
            <x-form-validation>Je valide !</x-form-validation>
        </div>
    </form>
</div>
@endsection
