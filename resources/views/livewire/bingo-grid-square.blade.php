@props(['square'])

<div wire:poll.1s wire:click="try_check" @class([
        'size-32 lg:size-36 rounded-lg flex items-center justify-center m-1 border border-4', 
        'hover:shadow-2xl transform hover:scale-110 duration-150',
        'font-bold' => $square->checked_at != null,
        "bg-[{$square->checked_by?->color}] border-gray-500" => $square->checked_by,
        "bg-white border-gray" => !$square->checked_by,
    ])>

    <div class="text-center select-none">
        <div>
            {{ $square->objective->game->name }}
        </div>
        <div>
            {{$square->objective->description}}
        </div>
    </div>
</div>