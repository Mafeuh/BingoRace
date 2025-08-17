<div>
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

    @if (!$user_team)
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
                <div class="text-xl text-center truncate">
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
                    @if (!$user_team)
                        <button class="bg-white py-1 px-2 shadow shadow-black rounded-full text-green-800 font-bold" wire:click='join_team({{ $team->id }})'>
                            {{ __('room.wait.team.join') }}
                        </button>
                    @endif

                    @if ($user_team?->id == $team->id)
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
</div>