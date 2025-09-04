@extends('layouts.app')

@section('content')
    <div class="relative">
        <h1 class="text-xl text-center font-bold text-emerald-500">
            {{ __('game.show.title', ['name' => $game->name]) }}
        </h1>
        <h2 class="text-center">
            @if ($game->is_official)
                {{ __('game.show.visibility.is_official') }}
            @elseif ($game->is_public)
                {{ __('game.show.visibility.is_public', ['name' => $game->creator?->name ?? '???']) }}
            @else
                {{ __('game.show.visibility.is_private') }}
            @endif
        </h2>
        <div class="hidden absolute right-2 top-2 transition-all duration-1000 lg:flex" x-data="{ show: true }">
            <form method="post" action="{{ route('game.flag', ['game' => $game->id]) }}" class="bg-red-100 p-1 rounded-full mr-2" :class="{ 'hidden': show }">
                @csrf
                <x-form.text-input placeholder="{{ __('game.show.flag.reason.label') }}" name="reason" />
                <button type="submit" class="bg-red-200 rounded-full border-red-500 border p-2">
                    {{ __('game.show.flag.reason.validate') }}
                </button>
            </form>
            <div class="bg-red-100 text-xl p-2 rounded-full border-2 border-red-400" x-on:click="show = !show">🚩</div>
        </div>
        
        @if (auth()->user()->isAdmin() || auth()->user()->id == $game->creator_id)
        <div>
            <div class="justify-center flex gap-x-4">
                <form method="post" action="{{ route('game.set_visibility', ['game' => $game->id]) }}" class="flex flex-col">
                    @csrf
                    <div>
                        <x-form.label>
                            {{ __('game.show.visibility.title') }}
                        </x-form.label>
                    </div>

                    <div class="flex gap-2">
                        @if(auth()->user()->isAdmin())
                            @if ($game->is_official)
                                <button type="submit" name="visibility" value="official_off" class="bg-green-300 hover:bg-green-500 p-1 rounded-full text-sm">
                                    {{ __('game.show.visibility.to_official_off') }}
                                </button>
                            @else
                                <button type="submit" name="visibility" value="official_on" class="bg-green-300 hover:bg-green-500 p-2 rounded-full text-sm">
                                    {{ __('game.show.visibility.to_official_on') }}
                                </button>
                            @endif
                        @endif

                        @if ($game->is_public)
                            <button type="submit" name="visibility" value="private" class="bg-green-300 hover:bg-green-500 p-2 rounded-full">
                                {{ __('game.show.visibility.to_private') }}
                            </button>
                        @else
                            <button type="submit" name="visibility" value="public" class="bg-green-300 hover:bg-green-500 p-2 rounded-full">
                                {{ __('game.show.visibility.to_public') }}
                            </button>
                        @endif
                    </div>
                </form>
                <form method="post" class="flex flex-col w-56" action="{{ route('game.set_language', ['game' => $game->id]) }}">
                    @csrf
                    <div>
                        <x-form.label for="lang">
                            {{ __('game.creation.form.language.label') }}
                        </x-form.label>
                    </div>
                    <div class="w-56">
                        <x-form.select-input name="lang" class="w-28">
                            @foreach (\App\Models\Game::$available_languages as $lang_slug => $lang_name)
                                <option value="{{ $lang_slug }}" @selected($lang_slug == $game->lang)>{{ $lang_name }}</option>
                            @endforeach
                        </x-form.select-input>
                        <button type="submit" class="bg-green-300 p-2 rounded-full w-fit">
                            {{ __('game.show.language.edit.submit') }}
                        </button>
                </form>
            </div>
        </div>
        @endif

        <div class="justify-center flex mt-2 lg:hidden">
            <form method="post" action="{{ route('game.flag', ['game' => $game->id]) }}" class="bg-red-100 p-2 rounded-lg">
                @csrf
                <div>
                    <h2 class="text-red-600 font-bold">
                        {{ __('game.show.flag.title') }} 🚩
                    </h2>
                </div>

                <x-form.text-input placeholder="{{ __('game.show.flag.reason.label') }}" name="reason" />
                <button type="submit" class="bg-red-200 rounded-full border-red-500 border p-2">
                    {{ __('game.show.flag.reason.validate') }}
                </button>

            </form>
        </div>
    </div>

    <div class="m-5 text-center">
        @if (auth()->user()->isAdmin())
            <div>
                {{ __('game.show.permissions.admin')}}
            </div>
        @else
            @if($game->is_public)
                <div>
                    {{ __('game.show.permissions.public_game') }}
                </div>
            @elseif ($game->creator_id == auth()->user()->id)
                <div>
                    {{ __('game.show.permissions.creator_auth') }}
                </div>
            @else
                <div>
                    {{ __('game.show.permissions.default', ['creator_name' => $game->creator?->name ?? '???']) }}
                </div>
            @endif
        @endif
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
        <div class="bg-white p-2 rounded-3xl">
            <h2 class="text-xl text-center mb-1">
                {{ __('game.show.public_objectives.title', ['amount' => sizeof($public_objectives)]) }}
                @if ($can_manage_public_objectives)
                    <span>
                        <a href="/games/{{$game->id}}/objective"
                            class="bg-green-500 p-1 rounded-full hover:bg-green-600 text-sm">➕</a>
                    </span>
                @endif
            </h2>
            @if(sizeof($public_objectives) > 0)
                <div class="grid grid-cols-1 xl:grid-cols-2 gap-2">
                    @foreach ($public_objectives as $pub_obj)
                        <div class="relative bg-gray-100 p-1 text-center rounded-xl">
                            @if ($can_manage_public_objectives)
                                <a class="absolute right-5" href="/objectives/{{$pub_obj->id}}/delete">❌</a>
                                <a class="absolute right-10" href="/objectives/{{$pub_obj->id}}/edit">✏️</a>
                            @endif
                            <div @class(['pr-14' => $can_manage_public_objectives])>
                                <span>
                                    {{$pub_obj->description}}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center">
                    {{ __('game.show.public_objectives.empty') }}
                </div>
            @endif

        </div>

        <div class="bg-white p-2 rounded-3xl">
            <h2 class="text-lg text-center mb-1">
                {{ __('game.show.private_objectives.title', ['amount' => sizeof($private_objectives)]) }}
                
                <span>
                    <a href="/games/{{$game->id}}/objective"
                    class="bg-green-500 p-1 rounded-full hover:bg-green-600 text-sm">
                    ➕
                    </a>
                </span>
            </h2>
            @if(sizeof($private_objectives) > 0)
                <div class="grid grid-cols-1 xl:grid-cols-2 gap-2">
                    @foreach ($private_objectives as $priv_obj)
                        <div class="relative bg-gray-100 p-1 text-center rounded-xl">
                            <a class="absolute right-5" href="/objectives/{{$priv_obj->id}}/delete">❌</a>
                            <a class="absolute right-10" href="/objectives/{{$priv_obj->id}}/edit">✏️</a>
                            <div class="pr-14">
                                <span>
                                    {{$priv_obj->description}}
                                </span>
                            </div>
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
        <div class="bg-red-100 m-5 p-2 border-red-200 border-4 space-y-2">
            <p class="text-lg text-red-400 font-bold">❗DANGER ZONE❗</p>

            <form action="{{ route('games.delete') }}" method="POST">
                @csrf
                <input type="hidden" name="game_id" value="{{$game->id}}">
                <button type="submit" class="bg-red-500 p-2 text-white font-bold rounded-full text-sm">
                    {{ __('game.show.danger.delete') }}
                </button>
            </form>

            <hr class="border-red-200 border-2">

            <form action="{{ route('games.rename')}}" method="POST">
                @csrf
                <input type="hidden" name="game_id" value="{{$game->id}}">
                <div>
                    <label class="text-red-500 font-bold" for="new_name">
                        {{ __('game.show.danger.rename.label') }}
                    </label>
                </div>
                <x-form.text-input :value="$game->name" name="new_name"/>
                <button type="submit" class="bg-red-500 p-2 text-white font-bold rounded-full text-sm">
                    {{ __('game.show.danger.rename.submit') }}
                </button>
            </form>

            <hr class="border-red-200 border-2">

            <form enctype="multipart/form-data" class="space-y-2" action="{{ route('games.change_image', ['game' => $game->id]) }}" method="POST">
                @csrf
                <div class="sm:w-96">
                    <label class="text-red-500 font-bold" for="new_name">
                        {{ __('game.show.danger.change_image.label') }}
                    </label>
                    <x-form.filedrop-input name="image" required="true"/>
                </div>
                <button type="submit" class="bg-red-500 p-2 text-white font-bold rounded-full text-sm">
                    {{ __('game.show.danger.change_image.submit') }}
                </button>
            </form>
        </div>
    @endif
@endsection
