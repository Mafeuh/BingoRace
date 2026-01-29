<div class="flex gap-x-2 justify-center">
    @foreach ($room->teams as $team)
        <div style="border-color:{{ $team->color }}; box-shadow: {{ $team->color }}" class="border-2 shadow-lg rounded-xl bg-black/50">
            <div class="bg-[{{$team->color}}]/20 p-2">
                <h1 style="color:{{ $team->color }}" class="text-center font-bold">
                    <span class="py-1 px-2 rounded-full bg-[{{$team->color}}]">{{ $team->name }}</span>- {{ sizeof($team->checked_objectives) }}
                </h1>
            </div>
        </div>
    @endforeach
</div>
