@extends('layouts.app')

@section('content')
    <div>
        <h1 class="text-center text-4xl mb-8">Bienvenue sur BingoRace !</h1>

        <h3 class="text-xl">Rejoindre une partie en cours</h3>
        <form action="/join" method="POST" class="flex">
            <input type="text" name="username" id="username" placeholder="Nom d'utilisateur" class="w-44 border-0 rounded-l-xl shadow-xl">
            <input type="text" name="username" id="username" placeholder="Code" class="text-center w-20 border-0 border-x shadow-xl">
            <button type="submit" class="
            flex items-center px-3 bg-green-100 rounded-r-xl shadow-xl
            hover:bg-green-600 hover:text-white hover:font-bold
            ">Rejoindre</button>
        </form>

        <h3 class="text-xl mt-5">Pour créer votre propre partie, vous devez d'abord <a class="underline" href="/login">vous connecter</a>.</h3>
    </div>
@endsection
