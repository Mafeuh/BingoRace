@extends('layouts.app')

@section('content')

<x-room-timer :room="\App\Models\Room::find(1)"/>

@endsection