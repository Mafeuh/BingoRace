@extends('layouts.app')

@section('page_title') Sélection de nom @endsection

@section('content')

<div class="flex justify-center">
    <x-secondary_panel class="w-fit space-y-2">
        <form method="post" action="/setname">
            @csrf
            <div>
                Choisis un pseudo !
                <x-form.text-input name="name" placeholder="Pseudo" value="{{ $name }}"/>
            </div>
            
            <div class="text-center">
                <x-form.submit-input>Confirmer</x-form.submit-input>
            </div>
        </form>
        <div class="max-w-96 text-gray-500 dark:text-gray-400 italic">
            Ce formulaire est prévu pour jouer sans être connecté. Si tu as un compte, c'est mieux de te connecter !
        </div>
    </x-secondary_panel>
</div>

@endsection