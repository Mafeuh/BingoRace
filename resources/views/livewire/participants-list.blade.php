@props(['room'])

<div wire:poll>
    <div class="text-xl text-center">{{ sizeof($room->teams) }} équipes</div>

    <div class="text-center">
        <i class="text-sm">Si tu peux pas supprimer une équipe, reload la page</i>
    </div>

    <div class="grid grid-cols-2">
        @foreach ($room->teams as $team)
            <div class="m-1 rounded-2xl p-2" style="background-color: {{ $team->color }}">
                <div class="text-xl text-center">
                    <p>{{ $team->name == '' ? '/' : $team->name}}</p>
                </div>
                <div class="text-center text-lg">
                    <span class="font-bold">{{ sizeof($team->participants) }}</span> membres
                </div>
                @foreach ($team->participants as $participant)
                    <div>- {{ $participant->user->name }}</div>
                @endforeach

                <div class="text-center">
                    @if ($player_team_id == -1)
                        <button wire:click='join_team({{ $team->id }})'>Rejoindre</button>
                    @endif

                    @if ($player_team_id == $team->id)
                        <button wire:click='leave_team()'>Quitter l'équipe</button>
                    @endif

                    @if (auth()->user()->id == $room->creator_id)
                        <button wire:click='delete_team({{ $team->id }})'>Supprimer</button>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    <h2 class="text-center text-2xl">Nouvelle équipe</h2>
    <div class="text-center grid grid-cols-3 gap-x-2">
        <input type="text" wire:model='new_team_name' class="border-0 focus:ring-0" placeholder="Nom...">
        <select
            name="new_team_color"
            wire:model='new_team_color'
            style="background-color: {{$new_team_color}}"
            onchange="changeBackgroundColor(this)">
            <option value="" disabled selected>Couleur</option>
            <option value="#ef4444" class="bg-red-500"></option>
            <option value="#f97316" class="bg-orange-500"></option>
            <option value="#eab308" class="bg-yellow-500"></option>
            <option value="#84cc16" class="bg-lime-500"></option>
            <option value="#10b981" class="bg-emerald-500"></option>
            <option value="#06b6d4" class="bg-cyan-500"></option>
            <option value="#6366f1" class="bg-indigo-500"></option>
            <option value="#d946ef" class="bg-fuchsia-500"></option>
        </select>

        <button wire:click='new_team' class="p-1 bg-gray-200 rounded-full hover:bg-gray-400">Nouvelle équipe</button>
    </div>
</div>
<script>
    function changeBackgroundColor(select) {
        var selectedOption = select.options[select.selectedIndex];
        var selectedColor = selectedOption.getAttribute('value');
        select.style.backgroundColor = selectedColor;
    }
</script>
