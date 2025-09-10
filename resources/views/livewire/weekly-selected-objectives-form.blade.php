<div>
    <div class="flex justify-center">
        <div class="bg-white grid grid-cols-2 gap-2 p-2 rounded-xl">
            <x-form.label>
                {{ __('room.setup.settings.grid.width') }}
            </x-form.label>
            <x-form.label>
                {{ __('room.setup.settings.grid.width') }}
            </x-form.label>
            <x-form.number-input min="0" max="10" wire:model="grid_width"/>
            <x-form.number-input min="0" max="10" wire:model="grid_height"/>
        </div>
    </div>
    <div>
        {{ sizeof($selected_objectives) }} objectifs choisis
    </div>
    <div class="bg-emerald-100 rounded-lg text-sm divide-y-2 divide-emerald-200 gap-y-1">
        @foreach ($selected_objectives as $selected_objective)
            <div>
                <span class="text-xs cursor-pointer" wire:click="select_objective({{$selected_objective->id}})">✖️</span>
                <span class="font-bold text-emerald-800">{{ $selected_objective->game->name }}</span>|
                {{ $selected_objective->description }}
            </div>
        @endforeach
    </div>
</div>