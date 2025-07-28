<div wire:poll.5s>
    <div class="grid-cols-{{$grid->width}} w-fit gap-1 static hidden lg:grid">
        @foreach ($grid->squares as $square)
            <div wire:click="try_check({{$square->id}})">
                <x-grid-square :square="$square" :player_team="$player_team"/>
            </div>
        @endforeach
    </div>
    <div class="grid grid-cols-{{$grid->width}} w-fit gap-1 static lg:hidden">
        @foreach ($grid->squares as $square)
            <div wire:click="mobile_preview({{$square->id}})">
                <x-grid-square-mobile :square="$square"/>
            </div>
        @endforeach
    </div>

    @if ($previewed_square)
        <div class="text-center lg:hidden bg-emerald-50 mt-5 p-2 rounded-lg">
            <h1 class="text-lg font-bold">
                {{ $previewed_square->objective->game->name }}
            </h1>
            <span>
                {{ $previewed_square->objective->description }}
            </span>

            <div>
                <button class="bg-emerald-500 p-2 rounded-full" wire:click="try_check_previewed">
                    {{ __('room.play.square.check') }}
                </button>
            </div>
        </div>
    @endif
</div>
