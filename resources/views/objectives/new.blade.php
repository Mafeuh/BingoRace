@extends('layouts.app')

@section('content')
    <div>
        <h1 class="text-3xl">Ajout d'un objectif pour {{ $game->name }}</h1>
        @if ($game->creator_id == auth()->user()->id)
            <div>Vous êtes administrateur pour la gestion de ce jeu. Vous pouvez décider de la visibilité de cet objectif.</div>
        @else
            <div>Vous ne pouvez créer que des objectifs privés.</div>
        @endif
    </div>

    <form method="POST" action="/games/{{$game->id}}/objective/post" class="w-1/4">
        @csrf
        <div class="flex flex-col">
            <label for="description">Description</label>
            <input type="text" name="description" id="description" required minlength="10" maxlength="255">
        </div>

        <div class="mt-5">
            <x-form-validation>Je valide !</x-form-validation>
        </div>
    </form>
@endsection
