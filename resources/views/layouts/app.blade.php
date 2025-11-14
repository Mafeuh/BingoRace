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
    <body class="h-screen flex flex-col">
        @php
            $is_maintenance = App\Models\Setting::get('maintenance') === "true";
        @endphp

        @if ($is_maintenance && auth()->user() && !auth()->user()->isAdmin())
            <div class="absolute w-full h-full bg-red-500/80 z-50 flex flex-col place-content-center items-center">
                <h1 class="text-5xl text-white font-bold">
                    {{ __('maintenance.title') }}
                </h1>
                <h2 class="text-2xl text-white">
                    {{ __('maintenance.come_back_later')}}
                </h2>
            </div>
        @endif

        <div class="bg-emerald-700 grid grid-cols-2 sm:grid-cols-3">
            <div class="hidden sm:inline">
                @auth
                    <form class="ml-5 absolute hidden sm:inline" method="POST" action="/join">
                        @csrf
                        <div class="font-bold text-white">{{ __('header.join_room.title') }}</div>
                        <div class="flex-col">
                            <div class="flex">
                                <input 
                                    name="code" 
                                    class="text-center bg-emerald-300 border-0 border-b-2 w-20 rounded-l-xl mr-0 focus:outline-none" 
                                    type="text" 
                                    maxlength="5" 
                                    placeholder="{{ __('header.join_room.code') }}">
                                <button class="bg-emerald-600 p-2 rounded-r-xl hover:bg-emerald-900 hover:text-white hover:font-extrabold" type="submit">
                                    {{ __('header.join_room_join') }}
                                </button>
                            </div>
                            <div>
                                @error('code')
                                    <div>{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </form>
                @endauth
            </div>
            
            @if(auth()->user()?->isAdmin())
                <div class="absolute top-0 text-emerald-500">
                    <span class="sm:hidden">XS</span>
                    <span class="hidden sm:inline md:hidden">SM</span>
                    <span class="hidden md:inline lg:hidden">MD</span>
                    <span class="hidden lg:inline xl:hidden">LG</span>
                    <span class="hidden xl:inline 2xl:hidden">XL</span>
                    <span class="hidden 2xl:inline">2XL</span>
                </div>
            @endif
                
                
            <div class="text-transparent text-2xl font-bold text-center flex justify-center relative my-3">
                <div class="w-min hover:scale-110 transform transition-all duration-300 ease-in-out rotate-1">
                    <a href="/" class="select-none bg-clip-text bg-gradient-to-r from-green-500 to-lime-200">
                        BingoRace!
                    </a>
                </div>
            </div>

            <div>
                <div class="absolute right-10 sm:hidden mt-3 z-50">
                    <x-burger-nav/>
                </div>

                @auth
                    <div class="absolute right-0 hidden sm:block top-2">
                        <x-header-profile-shortcut/>
                    </div>
                @endauth
            </div>
        </div>
        <div class="bg-gradient-to-b from-emerald-700 to-emerald-800">
            @auth
            <div class="text-center pb-2 hidden sm:block">
                <x-header-navbar></x-header-navbar>
            </div>
            @endauth
        </div>

        <div class="bg-emerald-100 px-4 lg:px-10 pb-32 pt-4 flex-grow relative bg-[linear-gradient(to_right,rgba(0,0,0,0.05)_1px,transparent_1px),linear-gradient(to_bottom,rgba(0,0,0,0.05)_1px,transparent_1px)] bg-[size:40px_40px]" style="">
            @yield('content')
        </div>

        <div class="fixed bottom-0 left-0 w-full">
            <hr>
            <x-footer></x-footer>
        </div>

        <script src="{{ mix('js/app.js') }}"></script>
        
    </body>
</html>
