<div class="space-y-0.5">
    <div wire:click="test">
        TEST
    </div>
    @for($i = 0; $i < $height; $i++)
    <div class="flex w-full space-x-0.5">
        @for($j = 0; $j < $width; $j++)
        <div class="w-full bg-white/20 rounded" style="aspect-ratio: 1/1">
            {{ $objectives[$width * $i + $j] }}
        </div>
        @endfor
    </div>
    @endfor
</div>