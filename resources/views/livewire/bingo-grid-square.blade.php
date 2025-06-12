@props(['square', 'editable', 'team'])

@php
    $color_class = 'bg-['.$square->checked_by?->color.']/50';
@endphp

<div wire:poll.1s x-data="{ mobile_preview: false }">
    {{-- Computer version --}}
    <div wire:click="try_check" title="{{ $square->objective->description }}" @class([
            'relative hidden lg:flex size-28 text-clip flex rounded-lg border lg:border-4', 
            'hover:shadow-2xl transform hover:scale-110 duration-150',
            'font-bold' => $square->checked_at != null,
            "border-gray-500" => $square->checked_by,
            "bg-white border-gray" => !$square->checked_by,
        ])>
        <div class="text-center select-none w-full max-h-full flex flex-col items-center justify-center">
            <div class="block lg:text-sm font-bold">
                {{ $square->objective->game->name }}
            </div>
            <div class="text-xs lg:text-sm w-full max-h-full text-ellipsis overflow-hidden">
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

    {{-- Mobile version --}}
    <div x-on:click="mobile_preview = !mobile_preview" class="lg:hidden select-none flex place-items-center justify-center fixed w-screen h-full left-0 top-0 bg-green-200/90" :class="{ 'hidden': !mobile_preview }">
        <div class="size-2/3 bg-white relative text-center p-2 flex flex-col place-items-center justify-center">
            <i class="absolute top-5">Appuie n'importe où pour fermer</i>
            <div>
                @if ($team)
                    @if ($square->checked_by_team_id == $team->id)
                        <button wire:click="try_check" class="bg-green-300 p-2 rounded-full">Décocher</button>
                    @endif
                    @if (!$square->checked_by)
                        <button wire:click="try_check" class="bg-green-300 p-2 rounded-full">Cocher</button>
                    @endif
                    
                @endif
            </div>

            <div class="font-bold">{{ $square->objective->game->name }}</div>
            <div class="text-sm">{{ $square->objective->description }}</div>

            @if ($square->checked_by)
                <span>Validé par l'équipe <span class="bg-[{{$square->checked_by?->color}}] p-1 rounded-lg">{{ $square->checked_by?->name }}</span></span>
            @endif


        </div>
    </div>

    <div x-on:click="mobile_preview = !mobile_preview" @class([
        'lg:hidden size-14 md:size-20', 
        "border-gray-500" => $square->checked_by,
        "bg-white border-gray" => !$square->checked_by,
        $color_class => $square->checked_by
    ])>
        <div class="text-xs text-center text-ellipsis overflow-hidden w-full max-h-full">
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
</div>