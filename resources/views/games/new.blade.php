@extends('layouts.app')

@section('content')
<div class="justify-center flex h-full">
    <form enctype="multipart/form-data" method="POST" action="{{ route('games.new_post') }}" class="bg-white px-40 py-10 rounded-3xl" name="blbblbblblb">
        @csrf
        <h1 class="text-3xl text-center font-bold">Création d'un jeu</h1>
        <div class="text-center my-5">
        @if ( in_array(1, auth()->user()->permissions->pluck('permission_id')->toArray()) )
            <p>Vous êtes admin ! Le jeu créé sera public.</p>
        @else
            <p>Vous ne pouvez créer que des jeux en visibilité privée.</p>
            @endif
        </div>

        <div class="flex flex-col">
            <x-input-label for="name">Nom</x-input-label>
            <x-custom-text-input name="name" placeholder="Nom du jeu" required="true"/>
            @error('name')
                <span class="text-red-500">{{ __($message) }}</span>
            @enderror
        </div>

        <div class="flex flex-col mt-5">
            <x-input-label for="public_objectives">Objectifs publics</x-input-label>
            <x-input-textbox name="public_objectives" placeholder="Objectif public 1\nObjectif public 2\n..."/>
        </div>

        <div class="flex flex-col mt-5">
            <x-input-label for="private_objectives">Objectifs privés</x-input-label>
            <x-input-textbox name="private_objectives" placeholder="Objectif privé 1\nObjectif privé 2\n..."/>
        </div>

        <div class="flex flex-col mt-5">
            <x-input-label for="preview_image">Image</x-input-label>
            <x-input-filedrop name="preview_image" message="Format optimal des images: 2/3 (largeur x hauteur: 100x150, 200x300...)"></x-input-filedrop>
            @error('preview_image')
                <span class="text-red-500">{{ __($message) }}</span>
            @enderror
        </div>

        <div class="mt-5 justify-center flex">
            <x-form-validation>Valider</x-form-validation>
        </div>
    </form>
</div>
@endsection
