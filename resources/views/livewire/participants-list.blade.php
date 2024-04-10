@props(['room'])

<div wire:poll>
    <div class="text-xl text-center">{{ sizeof($room->teams) }} équipes</div>

    <div class="grid grid-cols-2">
        @foreach ($room->teams as $team)
            <div class="bg-[{{$team->color}}] m-1">
                <div class="text-xl text-center">
                    <input class="w-full bg-transparent border-0 focus:ring-0 text-center"
                    type="text" value="{{ $team->name }}">
                </div>
                <div class="text-center text-lg">
                    <span class="font-bold">{{ sizeof($team->participants) }}</span> membres
                </div>
                @foreach ($team->participants as $participant)
                    <div>- {{ $participant->user->name }}</div>
                @endforeach

                <div class="text-center">
                    <button wire:click='join_team({{ $team->id }})'>Rejoindre</button>

                    @if (auth()->user()->id == $room->creator_id)
                        <button wire:click='delete_team({{ $team->id }})'>Supprimer</button>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    <div class="text-center">
        <input type="text" wire:model='new_team_name' class="w-1/4 border-0 focus:ring-0" placeholder="Nom...">
        <input type="color" wire:model='new_team_color' class="h-4 w-4">
        <button wire:click='new_team'>Nouvelle équipe</button>
    </div>
</div>
