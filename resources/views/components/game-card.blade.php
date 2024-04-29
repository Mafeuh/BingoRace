@props(['game'])

<div
    class="relative bg-white rounded-2xl transition-all hover:scale-105"
    style="padding-top: 125%; background-size:contain; background-repeat: no-repeat; background-image: url({{ asset($game->image_url) }});">
    <div class="absolute transition-all inset-0 w-full h-full bg-white/50 hover:bg-white/80 rounded-2xl flex justify-center items-center">
        <div class="text-center">
            <p class="text-xl font-thin">{{ $game->name }}</p>
        </div>
    </div>
</div>
