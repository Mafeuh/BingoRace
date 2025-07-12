@props([
    'square',
])

{{-- @php $color_class = 'bg-['.$square->checked_by?->color.']/50'; @endphp
<div>
    <div @class([
        'lg:hidden size-20', 
        "border-gray-500" => $square->checked_by,
        "bg-white border-gray" => !$square->checked_by,
        $color_class => $square->checked_by
    ])>
        <div class="text-xs text-center text-ellipsis overflow-scroll w-full max-h-full">
            <div class="font-bold">
                {{ $square->objective->game->name }}
            </div>
            {{ $square->objective->description }}
        </div>
        
        @if ($square->checked_by?->image_url)
            <div class="absolute w-full h-full -z-20 -p-2" style="background-image: url({{ asset($square->checked_by->image_url) }})">
            </div>
        @endif
    </div>
</div> --}}

<div></div>