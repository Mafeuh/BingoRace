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
    <div class="absolute w-full h-full -z-10">
        <div 
            @class([
                "bg-[{$square->checked_by?->color}]/70" => $square->checked_by?->image_url,
                "bg-[{$square->checked_by?->color}]" => $square->checked_by && !$square->checked_by?->image_url,
                "w-full h-full"
                ])>
        </div>
    </div>
    @if ($square->checked_by?->image_url)
    <div 
        class="absolute w-full h-full -z-20 -p-2" 
        style="
            background-image: url({{ asset($square->checked_by->image_url) }});
            background-size: cover;
            background-position: center;
        ">
    </div>
    @endif
</div>