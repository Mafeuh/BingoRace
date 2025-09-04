@extends('layouts.app')

@section('content')

<h1 class="text-xl text-center font-bold mb-3 text-emerald-600">
    {{ __('room.start.game_selection.title') }}
</h1>

<livewire:games-select/>

@endsection