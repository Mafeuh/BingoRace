@extends('layouts.app')

@section('content')
    @php
        $can_manage_public_objectives = auth()->user()->isAdmin() || auth()->user()->id == $game->creator_id;
    @endphp

    <h1 class="text-3xl text-center">Informations sur <span class="font-bold">{{$game->name}}</span></h1>

    <div class="m-5 text-center">
        @if (auth()->user()->isAdmin())
            <div>Vous êtes admin ! Vous avez tous les droits mouahahaha !</div>
        @else
            @if($game->creator_id == null)
                <div>Ce jeu est un jeu public ! N'importe qui peut ajouter ses propres objectifs dessus pour ses parties personnelles.</div>
            @elseif ($game->creator_id == auth()->user()->id)
                <div>C'est ton jeu, c'est tes règles ! Importe tes propres objectifs, privés ou publics !</div>
            @else
                <div>Ce jeu a été ajouté par {{$game->creator->name}}. C'est le/la seul.e personne à pouvoir ajouter des objectifs.</div>
            @endif
        @endif
    </div>

    <div class="grid grid-cols-2 gap-x-5">
        <div class="bg-green-100 p-5 rounded-3xl">
            <h2 class="text-2xl text-center mb-5">
                {{ sizeof($game->public_objectives) }} objectifs publics
                @if ($can_manage_public_objectives)
                    <span>
                        <a href="/games/{{$game->id}}/objective"
                            class="bg-green-500 px-3 py-3 rounded-full hover:bg-green-600">➕</a>
                    </span>
                @endif
            </h2>
            @if(sizeof($game->public_objectives) > 0)
                <div class="grid grid-cols-2 gap-2">
                    @foreach ($game->public_objectives as $pub_obj)
                        <div class="relative bg-white px-10 py-2 text-center rounded-xl">
                            @if ($can_manage_public_objectives)
                                <a class="absolute right-5" href="/objectives/{{$pub_obj->id}}/delete">❌</a>
                                <a class="absolute right-10" href="/objectives/{{$pub_obj->id}}/edit">✏️</a>
                            @endif
                            {{$pub_obj->description}}
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center">
                    Ce jeu n'a pas d'objectif public !
                </div>
            @endif

        </div>

        <div class="bg-green-100 p-5 rounded-3xl">
            <h2 class="text-2xl text-center mb-5">
                Tes {{ sizeof($game->private_objectives) }} objectifs personnalisés
                <span>
                    <a href="/games/{{$game->id}}/objective"
                    class="bg-green-500 px-3 py-3 rounded-full right hover:bg-green-600">
                    ➕
                    </a>
                </span>
            </h2>
            @if(sizeof($game->private_objectives) > 0)
                <div class="grid grid-cols-2 gap-2">
                    @foreach ($game->private_objectives as $priv_obj)
                        <div class="relative bg-white px-10 py-2 text-center rounded-xl">
                            <a class="absolute right-5" href="/objectives/{{$priv_obj->id}}/delete">❌</a>
                            {{$priv_obj->description}}
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center">
                    Vous n'avez pas encore créé d'objectif !
                </div>
            @endif
        </div>
    </div>

    @if (auth()->user()->isAdmin() || $game->creator_id == auth()->user()->id)
        <div class="bg-red-100 m-5 p-5 border-red-200 border-4">
            <p class="text-xl text-red-400 font-bold">❗DANGER ZONE❗</p>

            <form class="my-5" action="{{ route('games.delete') }}" method="POST">
                @csrf
                <input type="hidden" name="game_id" value="{{$game->id}}">
                <button type="submit" class="bg-red-500 p-3 text-white font-bold rounded-full">Supprimer le jeu</button>
            </form>
            <hr class="border-red-200 border-2">
            <form class="mt-5" action="{{ route('games.rename')}}" method="POST">
                @csrf
                <input type="hidden" name="game_id" value="{{$game->id}}">
                <div>
                    <label class="text-red-500 font-bold" for="new_name">Renommer le jeu</label>
                </div>
                <x-form.text-input :value="$game->name" name="new_name"/>
                <button type="submit" class="bg-red-500 p-3 text-white font-bold rounded-full">Valider</button>
            </form>
        </div>
    @endif
@endsection
