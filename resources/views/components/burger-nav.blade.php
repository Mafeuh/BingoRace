<div x-data="{ openedHover: false, openedClick: false }" class="relative flex-0" x-on:mouseover="openedHover=true"
     x-on:mouseout="openedHover=false">
    <div class="rounded-full size-14 bg-green-400 p-4 z-10" x-on:click="openedClick=!openedClick">
        <div>
            <svg clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"
                 viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="m7 17.75c0-.414.336-.75.75-.75h13.5c.414 0 .75.336.75.75s-.336.75-.75.75h-13.5c-.414 0-.75-.336-.75-.75zm-5-4c0-.414.336-.75.75-.75h18.5c.414 0 .75.336.75.75s-.336.75-.75.75h-18.5c-.414 0-.75-.336-.75-.75zm9-4c0-.414.336-.75.75-.75h9.5c.414 0 .75.336.75.75s-.336.75-.75.75h-9.5c-.414 0-.75-.336-.75-.75zm-7-4c0-.414.336-.75.75-.75h16.5c.414 0 .75.336.75.75s-.336.75-.75.75h-16.5c-.414 0-.75-.336-.75-.75z"
                    fill-rule="nonzero"/>
            </svg>
        </div>
    </div>

    <div x-show="openedClick || openedHover" class="absolute bg-green-100 border-8 border-green-500 flex-0 right-0 p-2 mt-2 rounded-xl">
        <form class="sm:hidden" method="POST" action="/join">
            @csrf
            <div class="flex">
                <div>
                    <x-form.label for="code">{{ __('header.join_room.title') }}</x-form.label>
                    <x-form.text-input 
                        name="code" 
                        maxlength="5" 
                        minlength="5" 
                        placeholder="{{ __('header.join_room.code') }}"
                    />
                    <div class="text-center">
                        <x-form.submit-input>{{ __('header.join_room_join') }}</x-form.submit-input>
                    </div>
                </div>
                <div>
                    @error('code')
                        <div>{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </form>
        <div class="text-center my-4">
            <a class="
                bg-emerald-300 px-3 relative py-2 text-lg rounded-full font-bold text-green-900 
                inline-flex transform duration-150 hover:scale-105" href="/weekly">
                @if (now()->dayOfWeek == 1)
                    <div class="absolute size-4 bg-yellow-500 -right-1 -top-1 rounded-full animate-ping"></div>
                    <div class="absolute size-4 bg-yellow-500 -right-1 -top-1 rounded-full"></div>
                @endif
                {{ __('header.weekly.home') }}
            </a>
        </div>
        <div class="text-center my-4">
            <a class="bg-white rounded-full shadow-lg px-5 py-2 font-bold text-green-900" href="/games/new">
                {{ __('header.nav.add_game') }}
            </a>
        </div>
        <div class="text-center my-4">
            <a class="bg-white rounded-full shadow-lg px-5 py-2 font-bold text-green-900" href="/games/list">
                {{ __('header.nav.list_games') }}
            </a>
        </div>
        <div class="text-center my-4">
            <a class="bg-white rounded-full shadow-lg px-5 py-2 font-bold text-green-900" href="/room/start">
                {{ __('header.nav.create_room') }}
            </a>
        </div>
    </div>
</div>
