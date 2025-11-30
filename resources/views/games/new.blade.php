@extends('layouts.app')

@section('page_title') {{ __('game.creation.title') }} @endsection

@section('content')

<div class="justify-center flex">
    <x-main-panel>
        <div class="m-2">
            <form class="space-y-2" enctype="multipart/form-data" method="POST" action="{{ route('games.new_post') }}" name="blbblbblblb">
                @csrf
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
                    <x-form.label for="lang">
                        {{ __('game.creation.form.language.label') }}
                    </x-form.label>
                    <x-form.select-input name="lang">
                        @foreach (\App\Models\Game::$available_languages as $lang_slug => $lang_name)
                        <option value="{{ $lang_slug }}" @selected($lang_slug == (app()->getLocale() ? app()->getLocale() : 'en'))>{{ $lang_name }}</option>
                        @endforeach
                    </x-form.select-input>
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
                    <div class="text-center text-sm dark:text-slate-200">
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
                    <x-form.filedrop-input name="preview_image" message="{{ __('game.creation.form.image.message') }}"></x-form.filedrop-input>
                    @error('preview_image')
                    <span class="text-red-500">{{ __($message) }}</span>
                    @enderror
                </div>
                <div class="mt-5 justify-center flex">
                    <x-form.submit-input>{{ __('game.creation.form.submit') }}</x-form.submit-input>
                </div>
            </form>
        </div>
    </x-main-panel>
</div>

@endsection
