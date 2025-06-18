@props(['game', 'show_objectives' => false])

<div
    class="relative rounded-2xl transition-all hover:scale-105 bg-gray-200"
    style="padding-top: 150%; background-position:center; background-size:cover; background-repeat: no-repeat; background-image: url({{ asset($game->image_url) }});">
    <div class="absolute transition-all inset-0 w-full h-full bg-white/50 hover:bg-white/80 rounded-2xl flex justify-center items-center">
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
    </div>
</div>
