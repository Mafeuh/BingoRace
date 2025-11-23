@extends('layouts.app')

@section('content')
    <div>
        <h1 class="text-center text-2xl mb-4 text-emerald-800">
            {{ __('home.welcome', ['name' => auth()->user()->name]) }}
        </h1>
    </div>
        <div class="xl:flex gap-4">
            <div class="text-justify bg-white p-3 rounded-3xl space-y-3 xl:w-1/2 2xl:w-1/3 h-fit mb-4">
                <h1 class="text-center text-emerald-600 text-lg font-bold">
                    {{ __('home.presentation.title') }}
                </h1>
    
                <p>{{ __('home.presentation.text1') }}</p>
                <p>{{ __('home.presentation.text2') }}</p>
                <p>{!! __('home.presentation.text3') !!}</p>
                <p>{!! __('home.presentation.text4') !!}</p>
                <p>{{ __('home.presentation.text5') }}</p>
    
                <hr class="border-emerald-300 border-4">
    
                <p>{{ __('home.presentation.text6') }}</p>
            </div>
    
            <div class="text-justify bg-white p-2 rounded-3xl space-y-2 xl:w-1/2 2xl:w-2/3">
                <div class="flex justify-center gap-2">
                    <h1 class="text-center text-emerald-600 text-lg font-bold m-1">
                        {{ __('home.posts.title') }}
                    </h1> 
                    @if(auth()->user()->isAdmin())
                        <span class="text-sm mt-2">
                            <a class="bg-emerald-500 p-2 rounded-full" href="{{ route('posts.new') }}">
                                {{ __('home.posts.new') }}
                            </a>
                        </span>
                    @endif
                </div>
    
                {{-- Conteneur scrollable --}}
                <livewire:posts-list/>
            </div>
    </div>
@endsection
