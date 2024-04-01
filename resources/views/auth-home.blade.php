@extends('layouts.app')

@section('content')
    <div>
        <h1 class="text-center text-4xl mb-8">Bienvenue {{ auth()->user()->name }} sur BingoRace !</h1>
    </div>
@endsection
