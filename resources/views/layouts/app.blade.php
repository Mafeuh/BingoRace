<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="BingoRace allows you to create Bingo rooms to play with your friends! Import games, objectives, and start playing!">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <script src="https://cdn.tailwindcss.com"></script>
        
        @livewireScripts 
        @vite([
            'resources/css/app.css',
            'resources/js/app.js'
        ])

        @livewireStyles

    </head>
    <body class="h-screen flex flex-col" x-data="{darkMode: $persist(true)}" :class="{'dark': darkMode }">
        @php
            $is_maintenance = App\Models\Setting::get('maintenance') === "true";
        @endphp

        @if ($is_maintenance && auth()->user() && !auth()->user()->isAdmin())
            <div class="fixed left-0 top-0 w-full h-full bg-red-500/80 z-50 flex flex-col place-content-center items-center">
                <h1 class="text-5xl text-white font-bold">
                    {{ __('maintenance.title') }}
                </h1>
                <h2 class="text-2xl text-white">
                    {{ __('maintenance.come_back_later')}}
                </h2>
            </div>
        @endif

        @auth
            <x-app.header/>
        @endauth

        <div class="bg-gradient-to-r dark:from-red-950 dark:to-blue-950 from-blue-300 to-red-300 flex-grow relative p-2 mb-12">
            <div>
                <h1 class="text-center text-2xl text-blue-500 mb-2">
                    @yield('page_title')
                </h1>
            </div>

            @yield('content')
        </div>

        <div class="fixed bottom-0 left-0 w-full">
            <x-footer></x-footer>
        </div>

        <script src="{{ mix('js/app.js') }}"></script>
        
    </body>
</html>
