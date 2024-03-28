<div class="text-center">
    @auth
        <form method="POST" action="/logout" class="py-5">
            @csrf
            <span>Connecté en tant que <b>{{ auth()->user()->name }}</b>
            <button type="submit" class="px-3 py-2 rounded-full bg-green-100 text-green-600 font-bold">Se déconnecter</button>
            </span>
        </form>
    @endauth
</div>
