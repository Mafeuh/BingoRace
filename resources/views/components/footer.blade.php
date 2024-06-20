<div class="text-center">
    <div class="relative">
        @if (session('error'))
            <div class="left-1/2 bottom-5 bg-red-200 absolute text-left px-5 py-3 -translate-x-1/2">
                <div class="font-bold text-red-600">
                    Erreur !
                </div>
                {{ session('error') }}
            </div>
        @endif
    </div>

    @auth
        <form method="POST" action="/logout" class="py-2">
            @csrf
            <span>Connecté en tant que <b>{{ auth()->user()->name }}</b>
            <button type="submit" class="px-3 py-2 rounded-full bg-green-100 text-green-600 font-bold">Se déconnecter</button>
            </span>
        </form>
    @endauth
</div>
