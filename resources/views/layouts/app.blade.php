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

        @livewireStyles
    </head>
    <body class="h-screen flex flex-col">
        <div class="bg-green-400 py-4">
            @auth
            <form class="absolute ml-5" method="POST" action="/join">
                @csrf
                <div>Rejoindre une partie</div>
                <div class="flex">
                    <input name="code" class="text-center bg-green-300 border-0 border-b-2 w-20 rounded-l-xl mr-0 focus:outline-none" type="text" maxlength="5" placeholder="Code">
                    <button class="bg-green-600 p-2 rounded-r-xl hover:bg-green-900 hover:text-white hover:font-extrabold" type="submit">Rejoindre</button>
                </div>
                @error('code')
                    <div>{{ $message }}</div>
                @enderror
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

        @livewireScripts
    </body>
</html>
