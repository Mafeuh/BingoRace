@props([
    'square',
    'player_team'
])

<div         
    @class([
        'relative flex text-clip size-28 flex rounded-lg border lg:border-4', 
        'hover:shadow-2xl transform hover:scale-110 duration-150',
        'font-bold' => $square->checked_at != null,
        "border-gray-500" => $square->checked_by,
        "bg-white border-gray" => !$square->checked_by,
    ])>
    <div class="text-center select-none w-full max-h-full flex flex-col items-center justify-center">
        <div class="block lg:text-sm font-bold">
            {{ $square->objective->game->name }}
        </div>
        <div class="text-xs w-full max-h-full text-ellipsis overflow-scroll">
            {{$square->objective->description}}
        </div>
    </div>
    <div class="absolute w-full h-full -z-10 bg-white">
        <div class="w-full h-full grid grid-cols-{{ min(sizeof($square->checked_by), 5) }}">
        @foreach ($square->checked_by as $team_it)
            @if ($team_it->image_url)
                <div style="
                    background-image: url({{ asset($team_it->image_url) }});
                    background-size: cover;
                    background-position: center;
                ">
                    <div class="bg-[{{$team_it->color}}]/70 w-full h-full"></div>
                </div>
            @else
                <div>
                    <div class="bg-[{{$team_it->color}}] w-full h-full"></div>
                </div>
            @endif
        @endforeach
        </div>
    </div>
</div>