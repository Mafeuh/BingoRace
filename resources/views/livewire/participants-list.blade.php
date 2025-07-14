@props(['room'])

<div wire:poll.1s>
    <div class="text-xl text-center">
        {{ __('room.wait.teams.title', ['amount' => sizeof($room->teams)])}}
    </div>
    @if (auth()->user()->id == $room->creator_id)
        <div class="text-center">
            <i class="text-sm">
                {{ __('room.wait.teams.reload_message') }}
            </i>
        </div>
    @endif

    @if (!$userTeam)
        <div class="bg-red-100 border-2 border-red-400 p-2">
            <h1 class="text-red-700 font-bold text-lg">
                ⚠️ {{ __('room.wait.teams.warning.title') }}
            </h1>
            <p>
                {{ __('room.wait.teams.warning.description') }}
            </p>
        </div>
    @endif

    <div class="grid grid-cols-2">
        @foreach ($room->teams as $team)
            <div class="m-1 rounded-2xl p-2" style="background-color: {{ $team->color }}">
                <div class="text-xl text-center">
                    <p>{{ $team->name == '' ? '/' : $team->name}}</p>
                </div>
                @if ($team->image_url)
                <div class="flex flex-0 justify-center my-2">
                    <p class="size-20 rounded-xl" style="background-image: url('{{ asset($team->image_url) }}'); background-position: center; background-size: cover;"></p>
                </div>
                @endif
                <div class="text-center text-lg">
                    <span class="font-bold">
                        {{ __('room.wait.team.members', ['amount' => sizeof($team->participants)]) }}
                    </span> 
                </div>

                <div class="space-y-2">
                    @foreach ($team->participants as $participant)
                        <span class="bg-white/70 py-1 shadow-lg px-2 rounded inline-block">{{ $participant->participantable->user->name }}@if ($participant->participantable->user->id == auth()->user()->id)&nbsp;({{ __('room.wait.team.self') }})@endif</span>
                    @endforeach
                </div>

                <div class="text-center space-y-2">
                    @if (!$userTeam)
                        <button class="bg-white py-1 px-2 shadow shadow-black rounded-full text-green-800 font-bold" wire:click='join_team({{ $team->id }})'>
                            {{ __('room.wait.team.join') }}
                        </button>
                    @endif

                    @if ($userTeam?->id == $team->id)
                        <button class="bg-white py-1 px-2 shadow shadow-black rounded-full font-bold" wire:click='leave_team()'>
                            {{ __('room.wait.team.quit') }}
                        </button>
                    @endif

                    @if (auth()->user()->id == $room->creator_id)
                        <button class="bg-white py-1 px-2 shadow shadow-black rounded-full text-red-600 font-bold" wire:click='delete_team({{ $team->id }})'>
                            {{ __('room.wait.team.delete') }}
                        </button>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    <p class="text-center text-xl py-2">
        {{ __('room.wait.teams.new_team.title') }}
    </p>
    <div class="space-y-5">
        <div class="flex flex-col">
            <x-form.label for="new_team_name">
                {{ __('room.wait.teams.new_team.name.label') }}
            </x-form.label>
            <x-form.text-input wire_model="new_team_name" placeholder="{{ __('room.wait.teams.new_team.name.placeholder') }}" name="new_team_name"/>
        </div>

        <div class="flex flex-col">
            <x-form.label for="new_team_color">{{ __('room.wait.teams.new_team.color.label') }}</x-form.label>
            <x-x-form.team-color-selector/>
        </div>

        <div class="flex flex-col">
            <x-form.label for="new_team_image">
                {{ __('room.wait.teams.new_team.image.label') }}
            </x-form.label>
            <x-form.filedrop-input wire_model="new_team_image" name="new_team_image" message="{{ __('room.wait.teams.new_team.image.message') }}"/>
            
            @if ($new_team_image != null)
            <div class="flex flex-0 justify-center m-5">
                <p class="rounded-lg size-60 bg-green-500" style="background-image: url({{ $new_team_image->temporaryUrl() }}); background-size:cover; background-position:center;"></p>
            </div>
            <div class="text-center">
                <button wire:click="remove_image" class="bg-gray-200 p-2 rounded-full">
                    {{ __('room.wait.teams.new_team.image.remove') }}
                </button>
            </div>
            @endif
            <div class="flex flex-0 justify-center m-5 gap-x-5">
                <button wire:click='new_team' class="p-2 bg-green-200 rounded-full hover:bg-green-400">
                    {{ __('room.wait.teams.new_team.create') }}
                </button>
                @if (!$userTeam)
                    <button wire:click='new_team_and_join' class="p-2 bg-green-200 rounded-full hover:bg-green-400">
                        {{ __('room.wait.teams.new_team.create_and_join') }}
                    </button>
                @endif
            </div>
        </div>

    </div>
</div>
<script>
    function changeBackgroundColor(select) {
        var selectedOption = select.options[select.selectedIndex];
        var selectedColor = selectedOption.getAttribute('value');
        select.style.backgroundColor = selectedColor;
    }
</script>
