<div class="text-center bg-white min-h-12">
    <div class="relative">
        @if (session('error'))
            <div class="left-1/2 bottom-5 bg-red-200 absolute text-left px-5 py-3 -translate-x-1/2">
                <div class="font-bold text-red-600">
                    Erreur !
                </div>
                {{ session('error') }}
            </div>
        @endif

        @if (session('message'))
            <div class="left-1/2 bottom-5 bg-white border-2 border-green-600 absolute text-left px-5 py-3 -translate-x-1/2">
                <div class="font-bold text-green-600">
                    🗒️ Information
                </div>
                {{ session('message') }}
            </div>
        @endif
    </div>
    <form method="POST" action="/logout" class="py-2">
        @csrf
        <div class="ml-2 flex gap-2 items-center absolute">
            <a href="{{ route('lang.switch', 'fr') }}" class="{{ App::getLocale() === 'fr' ? 'font-bold underline' : '' }}">
                🇫🇷 
            </a>
            <a href="{{ route('lang.switch', 'en') }}" class="{{ App::getLocale() === 'en' ? 'font-bold underline' : '' }}">
                🇬🇧 
            </a>
        </div>
        
        @auth
            <span>{{ __('footer.status.connected_as') }} <b>{{ auth()->user()->name . (auth()->user()->hasPermission('admin') ? ' 🗿' : '') }}</b>
                <button type="submit" class="px-3 py-2 rounded-full bg-green-100 text-green-600 font-bold">
                    {{ __('footer.status.logout') }}
                </button>
                @if (auth()->user()->isAdmin())
                    <a href="/admin" class="bg-red-100 px-3 py-2 rounded-full font-bold text-red-600">
                        {{ __('footer.status.admin_zone')}}
                    </a>
                @endif
            </span>
        @endauth
    </form>
</div>
