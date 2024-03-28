@extends('layouts.app')

@section('content')
    <div>
        <div class="text-2xl font-bold">Nouveau Jeu</div>

        <form action="/games/new/post" method="POST" class="grid grid-cols-2 w-1/4 space-y-2">
            @csrf
            <label for="name">Nom: </label>
            <input type="text" name="name" id="name">

            <label for="image_url">URL de l'image: </label>
            <input type="text" name="image_url" id="image_url">

            <x-form-validation>Valider</x-form-validation>
        </form>
    </div>
@endsection
