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
        {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
        
        @livewireScripts 
        @vite([
            'resources/css/app.css',
            'resources/js/app.js'
        ])

        @livewireStyles
    </head>
    <body :class="{'dark': darkMode }" class="h-screen flex flex-col bg-slate-900 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] bg-fixed" x-data="{darkMode: $persist(true)}">
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

        <div class="p-2 flex-grow overflow-auto inset-0 bg-gradient-to-br from-indigo-200/80 to-red-200/80 dark:from-blue-900/80 dark:to-red-900/80">
            <div>
                <h1 class="text-center text-2xl text-blue-500 font-bold mb-2">
                    @yield('page_title')
                </h1>
            </div>
            @yield('content')
        </div>

        <div class="w-full">
            <x-footer></x-footer>
        </div>

        <script src="{{ mix('js/app.js') }}"></script>
        
    </body>
</html>
