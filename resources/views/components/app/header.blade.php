<div class="bg-gray-200 dark:bg-slate-900 border-b-2 dark:border-black border-gray-400 p-1 h-14">
    <div class="mx-auto max-w-5xl justify-between items-center flex">
        <a href="/" class="group flex items-center gap-2 transition hover:scale-105">
            <span class="text-2xl font-black tracking-tighter text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-rose-400 group-hover:to-blue-400">
                BingoRace!
            </span>
        </a>
        <div class="flex space-x-4">
            @if (!auth()->check())
                <a href="/login" class="hover:scale-110 transition-all duration-100 bg-gradient-to-r from-red-400 to-blue-400 p-0.5 flex rounded-lg">
                    <span class="py-2 px-4 hover:dark:bg-blue-950/80 bg-gray-200/80 dark:text-slate-200 font-bold dark:bg-slate-900/80 rounded-lg">Login</span>
                </a>
            @endif
            <form method="POST" action="/join" class="relative group">
                @csrf
                <div class="absolute -inset-0.5 bg-gradient-to-r from-blue-500 to-rose-500 rounded-lg blur opacity-75 group-hover:opacity-100 transition duration-200"></div>
                <div class="relative flex bg-slate-300 dark:bg-slate-800 rounded-lg p-0.5" x-cloak x-data="{ show_code: false }">
                    <div class="my-auto px-2" x-on:click="show_code = !show_code">
                        <span x-show="show_code">
                            <x-icon.eye-show size="12"/>
                        </span>
                        <span x-show="!show_code">
                            <x-icon.eye-hidden size="12"/>
                        </span>
                    </div>
                    <input name="code" class="bg-slate-200 dark:bg-slate-900 text-white px-4 py-2 rounded-l-md focus:outline-none w-32 font-mono placeholder-slate-500 uppercase tracking-widest" 
                           x-bind:type="!show_code ? 'password' : 'text'" maxlength="5" placeholder="CODE">
                    <button class="bg-slate-500 hover:bg-slate-600 dark:bg-slate-800 dark:hover:bg-slate-700 text-white font-bold py-2 px-4 rounded-r-md transition border-l border-slate-700" type="submit">
                        GO
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>