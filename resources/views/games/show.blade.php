@extends('layouts.app')

@section('content')
    <h1 class="text-3xl">Informations sur {{$game->name}}</h1>

    <div class="text-xs">Ajouté le {{ $game->created_at->translatedFormat('l d m Y') }}</div>

    <div id="creator_info" class="m-5">
        @if($game->creator == null)
            <div>Ce jeu est un jeu public ! N'importe qui peut ajouter ses propres objectifs dessus pour ses parties personnelles.</div>
        @else
            <div>Ce jeu a été ajouté par {{$game->creator->name}}. C'est le/la seul.e personne à pouvoir ajouter des objectifs.</div>
        @endisset
    </div>

    <div>
        <img src="{{ asset($game->image_url) }}" alt="Image du jeu">
    </div>

    @if(sizeof($game->public_objectives) > 0)
        <div id="public_objectives">
            <h2 class="text-2xl">Objectifs publics</h2>
            @foreach ($game->public_objectives as $pub_obj)
            <div class="ml-5">{{$pub_obj->description}}</div>
            @endforeach
        </div>
    @endif

    @if(sizeof($game->user_objectives) > 0)
        <div id="user_objectives">
            <h2 class="text-2xl">Vos objectifs personnalisés</h2>
            @foreach ($game->user_objectives as $user_obj)
            <div class="ml-5">{{$user_obj->description}}</div>
            @endforeach
        </div>
    @endif
    <div id="add_objective">
        <h2 class="text-2xl">Vous n'aimez pas les objectifs disponibles ?</h2>
        <div><a href="/games/{{$game->id}}/objective">Et pourquoi pas en ajouter un ?</a></div>
    </div>
@endsection
