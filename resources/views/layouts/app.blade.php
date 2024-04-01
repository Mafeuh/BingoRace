<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    </head>
    <body class="h-screen flex flex-col">
        <div class="bg-green-400 py-4">
            <a class="absolute right-0 mr-5 px-5 py-2 bg-red-400 rounded-full" href="/debug/adminzone">DEBUG: Ne pas toucher</a>
            @auth
            <form class="absolute ml-5" method="POST" action="/join">
                <div>Rejoindre une partie</div>
                <div class="flex">
                    <input class="text-center bg-green-300 border-0 border-b-2 w-20 rounded-l-xl mr-0 focus:outline-none" type="text" maxlength="5" placeholder="Code">
                    <button class="bg-green-600 p-2 rounded-r-xl hover:bg-green-900 hover:text-white hover:font-extrabold" type="submit">Rejoindre</button>
                </div>
            </form>
            @endauth
            @guest
                <div class="absolute right-0">
                    <a class="bg-green-200 px-4 py-2 rounded-2xl" href="/login">Connexion</a>
                    <a class="bg-green-200 px-4 py-2 rounded-2xl" href="/register">Inscription</a>
                </div>
            @endguest

            <div class="text-white text-3xl font-bold text-center">BingoRace!</div>

            @auth
            <div class="text-center py-5">
                <x-header-navbar></x-header-navbar>
            </div>
            @endauth

        </div>

        <div class="bg-green-200 p-10 flex-grow">
            @yield('content')
        </div>

        <hr>
        <x-footer></x-footer>
    </body>
</html>
