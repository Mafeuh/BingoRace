@extends('layouts.app')

@section('page_title') {{ __('home.setname.title') }} @endsection

@section('content')

<div class="flex justify-center">
    <x-main-panel class="w-fit space-y-2 rounded p-4">
        <form method="post" action="/setname" class="space-y-2">
            @csrf
            <div class="dark:text-slate-200 text-slate-950">
                {{ __('home.setname.label') }}
                <x-form.text-input name="name" :placeholder="__('home.setname.placeholder')" value="{{ $name }}"/>
            </div>
            
            <div class="text-center">
                <x-form.submit-input>
                    {{ __('home.setname.confirm') }}
                </x-form.submit-input>
            </div>
        </form>
        <div class="max-w-96 text-gray-600 dark:text-gray-400 italic">
            {{ __('home.setname.description') }}
        </div>
    </x-main-panel>
</div>

@endsection