<div 
    wire:click="onClicked" 
    class="relative flex justify-center rounded-lg pt-[100%] bg-[{{ $team->color }}]/50"
    style="font-size: 10px"
>
    @if ($team->image_url)
        <div 
            class="absolute w-full h-full top-0 rounded-lg opacity-30" 
            style="
                background-image: url({{ asset($team->image_url) }});
                background-size: cover;
                background-position: center;
            "></div>
    @endif

    <div class="rounded-lg p-1 w-full h-full place-items-center justify-center flex absolute top-0" title="{{ $team->name }}">
        <div class="text-sm text-center text-nowrap overflow-auto scrollbar-hidden">
            {{ $team->name }}
            <h3 class="text-center">{{ \Carbon\Carbon::parse($team->created_at)->translatedFormat("l d M Y") }}</h3>
        </div>
    </div>

    <!-- div masquée par défaut -->
    <div 
        class="p-2 bg-white overflow-auto duration-200 z-10 rounded-xl text-justify absolute w-full h-full hover:scale-150 top-0 border-4 border-[{{ $team->color }}] opacity-0 hover:opacity-100"
    >
        <h2 class="p-1 font-bold text-center text-[{{ $team->color }}]">{{ $team->name }}</h2>

        <div>
            <h3 class="text-[{{ $team->color }}]">
                {{ __('profile.team.members.title') }}
            </h3>
            @foreach ($team->participants as $participant)
                @if ($participant->participantable_type == "App\\Models\\AuthParticipant")
                    <div>{{ $participant->participantable->user->name }}</div>
                @endif
            @endforeach
        </div>

        <div>
            <h3 class="text-[{{ $team->color }}]">
                {{ __('profile.team.checked.title') }}
            </h3>
            @forelse ($team->checked_objectives->sortBy('objective.game_id') as $objective)
                <div>
                    <span class="text-[{{ $team->color }}] font-bold">{{ $objective->objective->game->name }}</span>
                    {{ $objective->objective->description }}
                </div>
            @empty
                <div>
                    {{ __('profile.participations.team.empty') }}
                </div>
            @endforelse
        </div>
    </div>
</div>
