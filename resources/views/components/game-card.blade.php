@props(['game'])

<div
    class="relative bg-white rounded-2xl transition-all hover:scale-105"
    style="padding-top: 150%; background-position:center; background-size:cover; background-repeat: no-repeat; background-image: url({{ asset($game->image_url) }});">
    <div class="absolute transition-all inset-0 w-full h-full bg-white/50 hover:bg-white/80 rounded-2xl flex justify-center items-center">
        <div class="text-center">
            <p class="text-xl bg-white/50 p-1 rounded">{{ $game->name }}</p>
        </div>
    </div>
</div>
