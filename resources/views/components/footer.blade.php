<div class="text-center bg-white">
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

    @auth
    <form method="POST" action="/logout" class="py-2">
        @csrf
        <span>Connecté en tant que <b>{{ auth()->user()->name . (auth()->user()->hasPermission('admin') ? ' 🗿' : '') }}</b>
        <button type="submit" class="px-3 py-2 rounded-full bg-green-100 text-green-600 font-bold">Se déconnecter</button>
        <a href="/admin" class="bg-red-100 px-3 py-2 rounded-full font-bold text-red-600">Zone admin</a>
        </span>
    </form>
    @endauth
</div>
