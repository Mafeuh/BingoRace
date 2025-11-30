@props(['game', 'show_objectives' => false, 'redirect' => true, 'show_favorite_star' => true])

<div x-cloak class="relative rounded-2xl transition-all hover:scale-105 bg-gray-200 dark:bg-slate-900"
    style="padding-top: 150%; background-position:center; background-size:cover; background-repeat: no-repeat; background-image: url({{ asset($game->image_url) }});">
    <div>
        <a @if ($redirect) href="/games/{{$game->id}}" @endif 
            class="absolute transition-all inset-0 w-full h-full bg-white/50 dark:bg-slate-500/30 dark:hover:bg-slate-900/80 hover:bg-white/80 rounded-2xl flex justify-center items-center">
            <div class="text-center">
                <p class="text-xl bg-white/50 p-1 rounded">{{ $game->name }}</p>
                @if ($show_objectives)
                <p class="bg-white/50">
                    {{ __('game.card.public_objectives', ['amount' => sizeof($game->public_objectives)]) }}
                </p>
                <p class="bg-white/50">
                    {{ __('game.card.private_objectives', ['amount' => sizeof($game->private_objectives)]) }}
                </p>
                @endif
            </div>
        </a>
        @if($show_favorite_star)
            <div
                wire:click.stop
                class="absolute right-2 top-2 transition-all hover:scale-110 hover:bg-yellow-500/50 rounded-full"
            >
                @livewire('favorite-check', ['game_id' => $game->id], key('fav-'.$game->id))
            </div>
        @endif
    </div>
</div>
