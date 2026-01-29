@props([
    'square',
    'player_team',
    'round_tl' => true,
    'round_tr' => true,
    'round_bl' => true,
    'round_br' => true,
    'highlighted' => false
])

<div
    @class([
        'relative flex text-clip size-28 flex border border-2 overflow-hidden',
        'border-red-600 border-4' => $highlighted, 
        'hover:shadow-2xl border-gray-500 transform hover:scale-110 hover:z-10 duration-150',
        'font-bold' => $square->checked_at != null,
        "rounded-bl-lg" => $round_bl,
        "rounded-br-lg" => $round_br,
        "rounded-tl-lg" => $round_tl,
        "rounded-tr-lg" => $round_tr,
    ])>
    <div class="text-center select-none w-full max-h-full flex flex-col items-center justify-center">
        <div class="block lg:text-sm font-bold">
            {{ $square->objective->game->name }}
        </div>
        <div class="text-xs w-full max-h-16 overflow-hidden line-clamp-3 hover:overflow-y-scroll hover:line-clamp-none scrollbar-hidden">
            {{ $square->objective->description }}
        </div>
    </div>
    <div class="absolute w-full h-full -z-10 bg-white dark:bg-slate-600">
        <div class="w-full h-full grid grid-cols-{{ min(sizeof($square->checked_by), 5) }}">
        @foreach ($square->checked_by as $team_it)
            @if ($team_it->image_url)
                <div style="
                    background-image: url({{ asset($team_it->image_url) }});
                    background-size: cover;
                    background-position: center;
                ">
                    <div style="background-color: {{$team_it->color}}" class="opacity-50 w-full h-full"></div>
                </div>
            @else
                <div>
                    <div style="background-color: {{$team_it->color}}" class="w-full h-full"></div>
                </div>
            @endif
        @endforeach
        </div>
    </div>
</div>