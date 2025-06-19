@extends('layouts.app')

@section('content')
    @php
        $can_manage_public_objectives = auth()->user()->isAdmin() || auth()->user()->id == $game->creator_id;
    @endphp

    <div class="relative">
        <h1 class="text-3xl text-center">
            {{ __('game.show.title', ['name' => $game->name]) }}
        </h1>
        <div class="absolute right-2 top-2 transition-all duration-1000 flex" x-data="{ show: true }">
            <form method="post" action="{{ route('game.flag', ['game' => $game->id]) }}" class="bg-red-100 p-1 rounded-full mr-2" :class="{ 'hidden': show }">
                @csrf
                <x-form.text-input placeholder="{{ __('game.show.flag.reason.label') }}" name="reason" />
                <button type="submit" class="bg-red-200 rounded-full border-red-500 border p-2">
                    {{ __('game.show.flag.reason.validate') }}
                </button>
            </form>
            <div class="bg-red-100 text-xl p-2 rounded-full border-2 border-red-400" x-on:click="show = !show">🚩</div>
        </div>
    </div>

    <div class="m-5 text-center">
        @if (auth()->user()->isAdmin())
            <div>
                {{ __('game.show.permissions.admin')}}
            </div>
        @else
            @if($game->creator_id == null)
                <div>
                    {{ __('game.show.permissions.public_game') }}
                </div>
            @elseif ($game->creator_id == auth()->user()->id)
                <div>
                    {{ __('game.show.permissions.creator_auth') }}
                </div>
            @else
                <div>
                    {{ __('game.show.permissions.default') }}
                </div>
            @endif
        @endif
    </div>

    <div class="grid grid-cols-2 gap-x-5">
        <div class="bg-green-100 p-5 rounded-3xl">
            <h2 class="text-2xl text-center mb-5">
                {{ __('game.show.public_objectives.title', ['amount' => sizeof($game->public_objectives)]) }}
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
                    {{ __('game.show.public_objectives.empty') }}
                </div>
            @endif

        </div>

        <div class="bg-green-100 p-5 rounded-3xl">
            <h2 class="text-2xl text-center mb-5">
                {{ __('game.show.private_objectives.title', ['amount' => sizeof($game->private_objectives)]) }}
                
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
                    {{ __('game.show.private_objectives.empty') }}

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
                <button type="submit" class="bg-red-500 p-3 text-white font-bold rounded-full">
                    {{ __('game.show.danger.delete') }}
                </button>
            </form>
            <hr class="border-red-200 border-2">
            <form class="mt-5" action="{{ route('games.rename')}}" method="POST">
                @csrf
                <input type="hidden" name="game_id" value="{{$game->id}}">
                <div>
                    <label class="text-red-500 font-bold" for="new_name">
                        {{ __('game.show.danger.rename.label') }}
                    </label>
                </div>
                <x-form.text-input :value="$game->name" name="new_name"/>
                <button type="submit" class="bg-red-500 p-3 text-white font-bold rounded-full">
                    {{ __('game.show.danger.rename.submit') }}
                </button>
            </form>
        </div>
    @endif
@endsection
