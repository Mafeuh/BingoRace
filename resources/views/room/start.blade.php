@extends('layouts.app')

@section('page_title') {{ __('room.start.game_selection.title') }} @endsection

@section('content')

<livewire:games-select/>

@endsection