@extends('layouts.app')

@section('page_title') {{ __('game.list.title') }} @endsection

@section('content')

<div>
    <h1 class="text-xl text-center font-bold text-emerald-500"></h1>
    <div class="text-center my-3">
        <a href="/games/new" class="bg-blue-500 p-2 rounded-full text-sm hover:bg-blue-700">{{__('game.list.create')}}</a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-x-2 gap-y-5">
        <livewire:official-games-list/>
        <livewire:public-games-list/>
        <livewire:private-games-list/>
    </div>
</div>
@endsection
