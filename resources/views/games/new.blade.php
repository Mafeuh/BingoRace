@extends('layouts.app')

@section('content')
<div class="justify-center flex h-full">
    <form enctype="multipart/form-data" method="POST" action="{{ route('games.new_post') }}" class="bg-white p-4 rounded-3xl space-y-2" name="blbblbblblb">
        @csrf
        <h1 class="text-3xl text-center font-bold">{{ __('game.creation.title') }}</h1>

        <div class="flex flex-col">
            <x-form.label for="name">
                {{ __('game.creation.form.name.label') }}
            </x-form.label>
            <x-form.text-input name="name" placeholder="{{ __('game.creation.form.name.placeholder') }}" required="true"/>
            @error('name')
                <span class="text-red-500">{{ __($message) }}</span>
            @enderror
        </div>

        <div class="flex flex-col">
            <x-form.label for="public_objectives">
                {{ __('game.creation.form.public_objectives.label') }}
            </x-form.label>
            <x-form.textbox-input name="public_objectives" placeholder="{!! __('game.creation.form.public_objectives.placeholder') !!}"/>
        </div>

        <div class="flex flex-col">
            <x-form.label for="private_objectives">
                {{ __('game.creation.form.private_objectives.label') }}
            </x-form.label>
            <x-form.textbox-input name="private_objectives" placeholder="{!! __('game.creation.form.private_objectives.placeholder') !!}"/>
        </div>

        <div class="flex flex-col">
            <x-form.label for="visibility">
                {{ __('game.creation.form.visibility.label') }}
            </x-form.label>
            <x-form.select-input name="visibility" required="true">
                <option selected disabled value="">
                    {{ __('game.creation.form.visibility.placeholder') }}
                </option>
                @if (auth()->user()->isAdmin())
                    <option value="official">
                        {{ __('game.creation.form.visibility.value.official') }}
                    </option>
                @endif
                <option value="public">
                    {{ __('game.creation.form.visibility.value.public') }}
                </option>
                <option value="private">
                    {{ __('game.creation.form.visibility.value.private') }}
                </option>
            </x-form.select-input>
            <div class="text-center text-sm">
                @if (auth()->user()->isAdmin())
                <div>
                    <i>
                        {{ __('game.creation.visibility.subtitle.admin') }}
                    </i>
                </div>
                @endif
                <div>
                    <i>
                        {{ __('game.creation.visibility.subtitle.text1') }}
                    </i>
                </div>
                <div>
                    <i>
                        {{ __('game.creation.visibility.subtitle.text2') }}
                    </i>
                </div>
            </div>
        </div>

        <div class="flex flex-col mt-5">
            <x-form.label for="preview_image">{{ __('game.creation.form.image.label') }}</x-form.label>
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
