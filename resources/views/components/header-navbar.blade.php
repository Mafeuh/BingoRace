<div class="space-x-2">
    <a class="
        bg-emerald-300 px-3 relative py-2 text-lg rounded-full font-bold text-green-900 
        inline-flex transform duration-150 hover:scale-105" href="/weekly">
        @if (now()->dayOfWeek == 1)
            <div class="absolute size-4 bg-yellow-500 -right-1 -top-1 rounded-full animate-ping"></div>
            <div class="absolute size-4 bg-yellow-500 -right-1 -top-1 rounded-full"></div>
        @endif
        {{ __('header.weekly.home') }}
    </a>
    <a class="bg-green-50 rounded-full shadow-lg px-5 py-2 font-bold text-green-900" href="/games/new">
        {{ __('header.nav.add_game') }}
    </a>
    <a class="bg-green-50 rounded-full shadow-lg px-5 py-2 font-bold text-green-900" href="/games/list">
        {{ __('header.nav.list_games') }}
    </a>
    <a class="
        shadow-xl font-bold text-lg px-3 py-2 rounded-2xl inline-flex
        bg-gradient-to-tr from-lime-300 to-lime-500
        transform hover:scale-110 duration-150 hover:from-lime-500 hover:to-lime-700" href="/room/start">
        {{ __('header.nav.create_room') }}
    </a>
</div>
