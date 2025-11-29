<div class="relative bg-gray-200 dark:bg-slate-900 border-b-2 dark:border-black border-gray-400 p-2">
    <form class="absolute z-10" method="POST" action="/join">
        @csrf
        <div class="p-1 transition-all duration-1000 rounded w-min shadow-violet-500 shadow-sm
                    bg-gradient-to-r from-red-400 to-blue-400
                    dark:from-red-700 dark:to-blue-700">
            <div class="flex">
                <input name="code" class="border-none w-20 dark:bg-black rounded-l focus:outline-none p-1" 
                    type="text" maxlength="5" placeholder="{{ __('header.join_room.code') }}">
    
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

    <div class="text-transparent text-2xl my-2 font-bold text-center flex justify-center relative">
        <div class="w-min hover:scale-110 transform transition-all duration-300 ease-in-out rotate-1">
            <a href="/" class="select-none bg-clip-text bg-gradient-to-r from-blue-500 to-red-500">
                BingoRace!
            </a>
        </div>
    </div>
</div>