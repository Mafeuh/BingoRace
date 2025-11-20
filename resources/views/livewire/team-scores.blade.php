<div class="flex gap-x-2 justify-center">
    @foreach ($room->teams as $team)
        <div class="border-[{{$team->color}}] border-2 shadow-[{{$team->color}}] shadow-lg rounded-xl bg-white">
            <div class="bg-[{{$team->color}}]/20 p-2">
                <h1 class="text-center text-[{{$team->color}}] font-bold">
                    <span class="text-white py-1 px-2 rounded-full bg-[{{$team->color}}]">{{ $team->name }}</span> - {{ sizeof($team->checked_objectives) }}
                </h1>
            </div>
        </div>
    @endforeach
</div>
