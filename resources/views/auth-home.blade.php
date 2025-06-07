@extends('layouts.app')

@section('content')
    <div>
        <h1 class="text-center text-4xl mb-8 text-emerald-800">Bienvenue <span class="font-bold">{{ auth()->user()->name }}</span> sur BingoRace !</h1>
    </div>
    <div class="grid grid-cols-2 gap-x-4 gap-y-6 text-justify">
        <div class="bg-white p-5 rounded-3xl">
            <h1 class="text-center text-emerald-600 text-2xl font-bold">
                Présentation
            </h1>
            <p>Ce site permet de simplifier la création de grilles de Bingo avec des objectifs, mais aussi d'intégrer tes propres jeux s'ils ne sont pas déjà présents sur le site.</p>
            <p>Tu peux en quelques secondes créer une partie de Bingo, choisir un ou plusieurs jeux pour ta grille, choisir la taille de la grille, inviter des amis dans ta partie, créer des équipes et commencer à jouer !</p>

            <div class="justify-center flex m-5">
                <img src="{{ asset('storage/images/grille.png') }}" class="w-2/3" alt="">
            </div>

            <p>Le site contient des <a href="/games/list" class="text-emerald-600 font-bold">jeux pré-définis</a>, avec des objectifs publics que tout le monde peut utiliser.</p>
            <p>Si ils ne t'intéressent pas, tu peux <a href="/games/new" class="text-emerald-600 font-bold">ajouter le jeu que tu veux</a>, et y ajouter tous les objectifs que tu veux !</p>
            <hr class="border-emerald-200 border-2 my-4">
            <p>Il est aussi possible d'ajouter un timer à la partie !</p>
        </div>
        <div class="bg-white p-5 rounded-3xl">
            <h1 class="text-center text-emerald-600 text-2xl font-bold">
                Les boutons pratiques
            </h1>
            <div>
                <a href="/start">Créer un salon</a>
            </div>
            <div>
                <a href="/games/list">Liste des jeux publics</a>
            </div>
            <div>
                <a href="/games/new">Créer un nouveau jeu</a>
            </div>
            @if (sizeof(auth()->user()->private_games) > 0)
                <h2>Tes jeux</h2>
                @foreach (auth()->user()->private_games as $game)
                <div>
                    <a href="/games/{{$game->id}}">{{ $game->name }}</a>
                </div>
                    @endforeach
            @endif
        </div>
    </div>
    
@endsection
