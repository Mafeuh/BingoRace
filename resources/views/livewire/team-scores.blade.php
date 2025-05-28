<div class="bg-white p-5 grid xl:grid-cols-4 2xl:grid-cols-5 mx-20 justify-items-center grid-flow-col" wire:poll>
    @foreach ($room->teams as $team)            
        <div class="border-[{{$team->color}}] border-4 w-80 p-5 shadow-[{{$team->color}}] shadow-lg rounded-xl bg-[{{$team->color}}]/20">
            <div>
                <h1 class="text-center text-white text-xl font-bold">
                    <span class="bg-[{{$team->color}}] py-2 px-4 rounded-full">{{ $team->name }}</span>
                </h1>
            </div>
            <hr class="border-[{{$team->color}}] border-2 rounded-full my-5">
            <div class="text-center text-[{{$team->color}}] font-bold">
                {{ sizeof($team->checked_objectives) }} points
            </div>
        </div>
    @endforeach
</div>
