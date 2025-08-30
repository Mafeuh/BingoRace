@extends('layouts.app')

@section('content')
    <div>
        <h1 class="text-center text-4xl mb-8 text-emerald-800">
            {{ __('home.welcome', ['name' => auth()->user()->name]) }}
        </h1>
    </div>
        <div class="xl:flex gap-4">
            <div class="text-justify bg-white p-5 rounded-3xl space-y-5 xl:w-1/2 2xl:w-1/3 h-fit mb-4">
                <h1 class="text-center text-emerald-600 text-2xl font-bold">
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
    
            <div class="text-justify bg-white p-5 rounded-3xl space-y-5 xl:w-1/2 2xl:w-2/3">
                <div class="space-y-2">
                    <h1 class="text-center text-emerald-600 text-2xl font-bold">
                        {{ __('home.posts.title') }}
                    </h1>
        
                    @if(auth()->user()->isAdmin())
                        <div class="text-center">
                            <a class="bg-emerald-500 p-2 rounded-full" href="{{ route('posts.new') }}">
                                {{ __('home.posts.new') }}
                            </a>
                        </div>
                    @endif
                </div>
    
                {{-- Conteneur scrollable --}}
                <div class="max-h-[70vh] overflow-y-auto pr-2 space-y-4">
                    @forelse ($posts as $post)
                        <div class="w-full p-5 shadow-inner shadow-gray-300 rounded-3xl bg-gray-50">
                            <div class="text-2xl">
                                <h1 class="inline text-emerald-700 font-bold">
                                    {{ $post->title }}
                                </h1>
                                <span class="text-gray-400 text-xl">
                                    - {{ $post->author->name }}
                                </span>
                            </div>
                            <div class="text-gray-400">
                                {{ \Carbon\Carbon::parse($post->created_at)->format('M d Y') }}
                            </div>
                            <hr class="my-5">
                            <div>
                                {!! $post->description !!}
                            </div>
                        </div>
                    @empty
                        <div class="text-center text-red-500">
                            {{ __('home.posts.empty') }}
                        </div>
                    @endforelse
                </div>
            </div>
    </div>
@endsection
