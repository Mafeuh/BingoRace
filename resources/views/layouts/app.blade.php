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
        <link href="https://fonts.bunny.net/css?family=figtree:400,600,800&amp;display=swap" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <script src="https://cdn.tailwindcss.com"></script>
        
        @livewireScripts 
        @vite([
            'resources/css/app.css',
            'resources/js/app.js'
        ])

        @livewireStyles

    </head>
    <body class="h-full flex flex-col bg-slate-900 text-slate-200 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] bg-fixed" x-data="{darkMode: $persist(true)}" :class="{'dark': darkMode }">
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

        <x-app.header/>

        <div class="fixed inset-0 z-[-1] bg-gradient-to-br dark:from-indigo-900 dark:via-slate-900 dark:to-red-900 from-indigo-300 via-slate-300 to-red-300 opacity-80">
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
