@extends('layouts.app')

@section('content')
    <h1 class="text-3xl text-center">Informations sur <span class="font-bold">{{$game->name}}</span></h1>

    <div class="m-5 text-center">
        @if($game->creator_id == null)
            <div>Ce jeu est un jeu public ! N'importe qui peut ajouter ses propres objectifs dessus pour ses parties personnelles.</div>
        @elseif ($game->creator_id == auth()->user()->id)
            <div>C'est ton jeu, c'est tes règles ! Importe tes propres objectifs, privés ou publiques !</div>
        @else
            <div>Ce jeu a été ajouté par {{$game->creator->name}}. C'est le/la seul.e personne à pouvoir ajouter des objectifs.</div>
        @endisset
    </div>

    <div class="grid grid-cols-2 gap-x-5">
        <div class="bg-green-100 p-5 rounded-3xl">
            <h2 class="text-2xl text-center mb-5">Objectifs publics</h2>
            @if(sizeof($game->public_objectives) > 0)
                <div class="grid grid-cols-2 gap-2">
                    @foreach ($game->public_objectives as $pub_obj)
                        <div class="relative bg-white px-10 py-2 text-center rounded-xl">
                            @if ($game->creator_id == auth()->user()->id)
                                <a class="absolute right-5" href="/objectives/{{$pub_obj->id}}/delete">❌</a>
                            @endif
                            {{$pub_obj->description}}
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center">
                    Ce jeu n'a pas d'objectif publique !
                </div>
            @endif

            @if ($game->creator_id == auth()->user()->id)
                <div class="text-right mt-10">
                    <a href="/games/{{$game->id}}/objective"
                        class="bg-green-500 px-3 py-3 rounded-full right hover:bg-green-600">➕</a>
                </div>
            @endif
        </div>

        <div class="bg-green-100 p-5 rounded-3xl">
            <h2 class="text-2xl text-center mb-5">Tes objectifs personnalisés</h2>
            @if(sizeof($game->private_objectives) > 0)
                <div class="grid grid-cols-2 gap-2">
                    @foreach ($game->private_objectives as $priv_obj)
                        <div class="relative bg-white px-10 py-2 text-center rounded-xl">
                            <a class="absolute right-5" href="/objectives/{{$priv_obj->id}}/delete">❌</a>
                            {{$priv_obj->description}} {{ $priv_obj->id }}
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center">
                    Vous n'avez pas encore créé d'objectif !
                </div>
            @endif

            <div class="text-right mt-10">
                <a href="/games/{{$game->id}}/objective"
                    class="bg-green-500 px-3 py-3 rounded-full right hover:bg-green-600">➕</a>
            </div>
        </div>
    </div>

    <details>
        <pre>
            {{ json_encode($game, JSON_PRETTY_PRINT) }}
        </pre>
    </details>
@endsection
