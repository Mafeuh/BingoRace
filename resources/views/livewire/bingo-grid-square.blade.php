@props(['square'])

<div wire:click="try_check" @class([
        'size-32 lg:size-36', 
        'font-bold' => $square->checked_at != null,
        "bg-[{$square->checked_by?->color}]" => $square->checked_by
    ])>

    <div class="text-center select-none">
        {{$square->objective->description}}
    </div>

</div>