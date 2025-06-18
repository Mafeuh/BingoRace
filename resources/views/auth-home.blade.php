@extends('layouts.app')

@section('content')
    <div>
        <h1 class="text-center text-4xl mb-8 text-emerald-800">
            {{ __('home.welcome', ['name' => auth()->user()->name]) }}
        </h1>
    </div>
    <div class="flex justify-center">
        <div class="lg:w-1/2 text-justify">
            <div class="bg-white p-5 rounded-3xl space-y-5">
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
        </div>
    </div>
    
@endsection
