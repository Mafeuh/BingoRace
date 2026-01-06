<x-main-panel>
    <div class="text-xl text-center dark:text-gray-200">
        {{ __('room.wait.teams.title', ['amount' => sizeof($room->teams)])}}
    </div>
    
    @if (!$user_teams)
        <div class="rounded bg-red-100 dark:bg-red-950 border-2 border-red-400 dark:border-red-900 p-2">
            <h1 class="text-red-700 font-bold text-lg">
                ⚠️ {{ __('room.wait.teams.warning.title') }}
            </h1>
            <p class="dark:text-gray-200">
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
                        <span class="bg-white/70 py-1 shadow-lg px-2 rounded inline-block">
                            {{ $participant->get_name() }}
                            @if($this->check_if_you($participant))
                                <span>
                                    ({{ __('room.wait.team.self') }})
                                </span>
                            @endif
                        </span>
                    @endforeach
                </div>
    
                <div class="text-center space-y-2">
                    @if (sizeof($user_teams) == 0)
                        <button class="bg-white py-1 px-2 shadow shadow-black rounded-full text-green-800 font-bold" wire:click='join_team({{ $team->id }})'>
                            {{ __('room.wait.team.join') }}
                        </button>
                    @endif
    
                    @if (in_array($team->id, $user_teams->pluck('id')->toArray()))
                        <button class="bg-white py-1 px-2 shadow shadow-black rounded-full font-bold" wire:click='leave_team()'>
                            {{ __('room.wait.team.quit') }}
                        </button>
                    @endif
    
                    @if (auth()->check() && auth()->user()->id == $room->creator_id)
                        <button class="bg-white py-1 px-2 shadow shadow-black rounded-full text-red-600 font-bold" wire:click='delete_team({{ $team->id }})'>
                            {{ __('room.wait.team.delete') }}
                        </button>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</x-main-panel>