@extends('layouts.app')

@section('page_title')
{{ __('home.welcome', ['name' => auth()->user()->name]) }}
@endsection

@section('content')
    <div class="justify-center flex">
        <x-secondary_panel class="w-96 my-2">
            <p class="text-blue-400 font-bold">
                {{ __('home.quick_access.title') }}
            </p>

            <div class="p-2 flex justify-center">
                <a href="/room/start" class="post">
                    <x-form.button class="text-sm">
                        {{ __('home.quick_access.start') }}
                    </x-form.button>
                </a>
                <a href="/games/list" class="post">
                    <x-form.button class="text-sm">
                        {{ __('home.quick_access.game_list') }}
                    </x-form.button>
                </a>
                <a href="/games/new" class="post">
                    <x-form.button class="text-sm">
                        {{ __('home.quick_access.game_new') }}
                    </x-form.button>
                </a>
            </div>
        </x-secondary_panel>
    </div>
    <div class="block lg:flex gap-2 justify-center">
        <x-main-panel class="text-justify rounded-l lg:w-1/2 xl:w-1/3 space-y-2 dark:text-gray-300">
            <h1 class="text-center text-blue-500 text-lg font-bold">
                {{ __('home.presentation.title') }}
            </h1>
    
            <p>{{ __('home.presentation.text1') }}</p>
            <p>{{ __('home.presentation.text2') }}</p>
            <p>{!! __('home.presentation.text3') !!}</p>
            <p>{!! __('home.presentation.text4') !!}</p>
            <p>{{ __('home.presentation.text5') }}</p>
    
            <div class="h-2 bg-blue-300 dark:bg-blue-500"></div>
        </x-main-panel>

        <x-main-panel class="text-justify rounded-r lg:w-1/2 xl:w-2/3 mt-2 lg:mt-0">
            <div class="flex justify-center gap-2">
                <h1 class="text-center text-blue-500 text-lg font-bold m-1">
                    {{ __('home.posts.title') }}
                </h1> 
                @if(auth()->user()->isAdmin())
                    <span class="text-sm mt-2">
                        <a class="bg-blue-500 p-2 rounded-full" href="{{ route('posts.new') }}">
                            {{ __('home.posts.new') }}
                        </a>
                    </span>
                @endif
            </div>
    
            {{-- Conteneur scrollable --}}
            <livewire:posts-list/>
        </x-main-panel>
    </div>
@endsection
