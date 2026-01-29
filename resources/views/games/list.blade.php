@extends('layouts.app')

@section('page_title') {{ __('game.list.title') }} @endsection

@section('content')

<div>
    <h1 class="text-xl text-center font-bold text-emerald-500"></h1>
    <div class="text-center my-4">
        <a href="/games/new" class="border-2 hover:border-slate-400 dark:hover:border-slate-700 rounded-xl dark:text-white text-slate-900 border-slate-300 bg-slate-100 dark:border-slate-600 dark:bg-slate-900/50 p-3">
            ➕ {{__('game.list.create')}}
        </a>
    </div>

    <div class="gap-x-2 gap-y-5 flex justify-center [&>*]:w-1/3">
        <livewire:official-games-list/>
        <livewire:public-games-list/>
        @auth
        <livewire:private-games-list/>
        @endauth
    </div>
</div>
@endsection
