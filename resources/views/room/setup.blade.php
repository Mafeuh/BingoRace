@extends('layouts.app')

@section('page_title') {{ __('room.setup.title') }} @endsection

@section('content')

<livewire:room-setup :room="$room"/>

@endsection
