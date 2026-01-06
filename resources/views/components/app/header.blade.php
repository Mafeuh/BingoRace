<div class="relative bg-gray-200 dark:bg-slate-900 border-b-2 dark:border-black border-gray-400 p-1">
    <form class="absolute z-10" method="POST" action="/join">
        @csrf
        <div class="p-1 transition-all duration-1000 rounded w-min shadow-violet-500 shadow-sm
                    bg-gradient-to-r from-red-400 to-blue-400
                    dark:from-red-700 dark:to-blue-700">
            <div class="flex" x-cloak x-data="{ show_code: false }">
                <div class="p-2" x-on:click="show_code = !show_code">
                    <span x-show="show_code">
                        <x-icon.eye-show size="20"/>
                    </span>
                    <span x-show="!show_code">
                        <x-icon.eye-hidden size="20"/>
                    </span>
                </div>
                <input name="code" class="border-none w-20 dark:bg-black text-gray-500 rounded-l focus:outline-none p-1" 
                    x-bind:type="!show_code ? 'password' : 'text'" maxlength="5" placeholder="{{ __('header.join_room.code') }}">
    
                <button 
                    class="font-bold w-max p-1 rounded-r px-2
                        bg-blue-500 hover:bg-blue-600 hover:text-white
                        dark:bg-blue-700 hover:dark:bg-blue-600" type="submit">
                    {{ __('header.join_room_join') }}
                </button>
            </div>
        </div>
        <div>
            @error('code')
                <div>{{ $message }}</div>
            @enderror
        </div>
    </form>

    <div class="text-transparent text-xl my-2 font-bold text-center flex justify-center relative">
        <div class="w-min hover:scale-110 transform transition-all duration-300 ease-in-out rotate-1">
            <a href="/" class="select-none bg-clip-text bg-gradient-to-r from-blue-500 to-red-500">
                BingoRace!
            </a>
        </div>
    </div>
</div>