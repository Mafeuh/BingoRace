@extends('layouts.app')

@section('content')
    <div>
        <h1 class="text-center text-2xl mb-4 text-blue-500">
            {{ __('home.welcome', ['name' => auth()->user()->name]) }}
        </h1>
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
    
            <div class="h-2 bg-blue-500"></div>
    
            <p>{{ __('home.presentation.text6') }}</p>
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
