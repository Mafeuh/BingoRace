@extends('layouts.app')

@section('content')
<div class="justify-center flex h-full">
    <form enctype="multipart/form-data" method="POST" action="{{ route('games.new_post') }}" class="bg-white p-4 rounded-3xl" name="blbblbblblb">
        @csrf
        <h1 class="text-3xl text-center font-bold">{{ __('game.creation.title') }}</h1>
        <div class="text-center my-5">
        @if (auth()->user()->isAdmin())
            <p>{{ __('game.creation.visibility.subtitle.admin') }} </p>
        @else
            <p>{{ __('game.creation.visibility.subtitle') }} </p>
        @endif
        </div>

        <div class="flex flex-col">
            <x-input-label for="name">{{ __('game.creation.form.name.label') }}</x-input-label>
            <x-custom-text-input name="name" placeholder="{{ __('game.creation.form.name.placeholder') }}" required="true"/>
            @error('name')
                <span class="text-red-500">{{ __($message) }}</span>
            @enderror
        </div>

        <div class="flex flex-col mt-5">
            <x-input-label for="public_objectives">{{ __('game.creation.form.public_objectives.label') }}</x-input-label>
            <x-input-textbox name="public_objectives" placeholder="{!! __('game.creation.form.public_objectives.placeholder') !!}"/>
        </div>

        <div class="flex flex-col mt-5">
            <x-input-label for="private_objectives">{{ __('game.creation.form.private_objectives.label') }}</x-input-label>
            <x-input-textbox name="private_objectives" placeholder="{!! __('game.creation.form.private_objectives.placeholder') !!}"/>
        </div>

        <div class="flex flex-col mt-5">
            <x-input-label for="preview_image">{{ __('game.creation.form.image.label') }}</x-input-label>
            <x-input-filedrop name="preview_image" message="{{ __('game.creation.form.image.message') }}"></x-input-filedrop>
            @error('preview_image')
                <span class="text-red-500">{{ __($message) }}</span>
            @enderror
        </div>

        <div class="mt-5 justify-center flex">
            <x-form-validation>{{ __('game.creation.form.submit') }}</x-form-validation>
        </div>
    </form>
</div>
@endsection
