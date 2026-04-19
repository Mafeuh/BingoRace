@extends('layouts.app')

@section('content')
    <h1 class="text-center dark:text-white text-slate-900 text-3xl font-bold my-5">
        {{ __('home.welcome.guest') }}
    </h1>

    <div class="max-w-lg flex mx-auto justify-between text-xl my-8">
        <div>
            <a href="/games/new" class="border-2 rounded-xl hover:border-slate-400 dark:hover:border-slate-700 dark:text-white text-slate-900 border-slate-300 bg-slate-100 dark:border-slate-600 dark:bg-slate-900 opacity-80 p-3">
                👤 {{ __('login.button') }}
            </a>
        </div>
        <div>
            <a href="{{ route('games.list') }}" class="border-2 hover:border-slate-400 dark:hover:border-slate-700 rounded-xl dark:text-white text-slate-900 border-slate-300 bg-slate-100 dark:border-slate-600 dark:bg-slate-900 opacity-80 p-3">
                📜 {{ __('home.quick_access.game_list') }}
            </a>
        </div>
    </div>

    <div class="max-w-5xl flex mx-auto justify-between relative" x-data="{ show_patch_notes: false }">
        <div class="w-1/3 text-justify text-slate-700 dark:bg-white/5 backdrop-blur-xl bg-white/20 p-6 border border-gray-300 dark:border-gray-600 rounded-l-lg">
            <h2 class="text-blue-500 text-lg font-bold">
                {{ __('home.presentation.title') }}
            </h2>
            <p>
                {!! __('home.presentation') !!}
            </p>
        </div>

        <div class="w-2/3 pl-6">
            <div class="flex justify-between">
                <h2 class="text-blue-500 text-xl font-bold">
                    📰 {{ __('home.posts.title') }}
                </h2>
                <span class="py-0.5 px-1.5 text-sm border rounded-full border-gray-500 bg-gray-500/10 text-gray-500 cursor-pointer" x-on:click="show_patch_notes = true">
                    Patch notes
                </span>
            </div>
            <div class="space-y-4 mt-4">
                @foreach ($posts as $post)
                <div class="border-y border-r dark:border-black/50 border-slate-300 rounded-lg">
                    <div class="transition-all duration-100 border-l-4 pl-4 p-2 rounded-lg border-{{ $colors[$loop->index] }}-500 bg-white/30 hover:bg-white/60 dark:bg-black/30 dark:hover:bg-black/40">
                        <span class="justify-between flex">
                            <h3 class="text-{{ $colors[$loop->index] }}-500 text-lg font-bold">
                                {{ $post->title }}
                            </h3>
                            <span class="text-slate-500">
                                {{ $post->author->name }} - 
                                {{ \Carbon\Carbon::parse($post->created_at)->translatedFormat('d M Y') }}
                            </span>
                        </span>
                        <div class="text-slate-700 dark:text-slate-200">
                            {!! $post->description !!}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="absolute bg-black/50 backdrop-blur-sm p-2 rounded-lg border w-full" x-cloak x-show="show_patch_notes">
            <div class="flex justify-between">
                <h2 class="text-gray-200 text-lg ml-2 font-bold">Patch notes</h2>
                <span class="cursor-pointer" x-on:click="show_patch_notes = false">❌</span>
            </div>

            <ul class="list-disc ml-4 divide-y text-slate-200 max-h-96 overflow-auto">
                @foreach ($patch_notes as $patch)
                    <li class="py-4">
                        <span>{{ $patch->created_at }}</span> - {{ $patch->description }}
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
