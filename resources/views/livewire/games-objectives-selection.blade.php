<div>
    <div class="flex justify-center">
        <div class="w-96 bg-gray-100 p-2">
            <h1 class="text-center text-xl font-bold">
                {{ __('room.setup.settings.grid.title') }}
            </h1>

            <div class="grid sm:grid-cols-2">
                <div class="text-center">
                    <x-form.label for="grid_width">
                        {{ __('room.setup.settings.grid.width') }}
                    </x-form.label>
                    <input type="number" wire:model.live="width" class="w-32 border-1 border-gray-200 rounded-full text-center py-3">
                </div>
    
                <div class="text-center">
                    <x-form.label for="grid_height">
                        {{ __('room.setup.settings.grid.height') }}
                    </x-form.label>
                    <input type="number" wire:model.live="height" class="w-32 border-1 border-gray-200 rounded-full text-center py-3">
                </div>
            </div>
        </div>
    </div>

    <div class="text-xl font-bold text-center">
        {{ __('room.setup.objectives_pool.title') }}
    </div>
    <div class="text-center">
        Greyed-out objectives will be ignored in the final selection of objectives
    </div>
    
    
    <div>
        <x-games-repartition-slider :pool_size="$pool_size" :height="$height" :width="$width" :room="$room"/>

        <div class="text-center">Objectifs possibles : <span id="count" wire:ignore></span> / <span>{{ $width * $height }}</span></div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 gap-1">
            @foreach ($room->games as $game)
            <div class="relative" style="padding-bottom: 100%">
                <div @class([
                    'absolute w-full h-full rounded flex flex-col border-4 border-emerald-200',
                    'bg-emerald-100' => $loop->odd,
                    'bg-emerald-50' => $loop->even,
                    ])>
                        <div class="p-2 justify-center">
                            <h2 class="text-center text-xl">{{ $game->name }}</h2>
                        </div>
                        
                        <div class="bg-emerald-200 text-center text-sm font-bold"></div>
                        
                        <div class="flex-1 overflow-y-auto p-2 space-y-1 text-sm scrollbar-hidden">
                            <div class="bg-white rounded-lg shadow-inner p-1">
                                
                                @foreach ($game->public_objectives as $objective)
                                <div class="border-b">
                                    <label for="check_{{$objective->id}}">
                                        <input class="hidden" type="checkbox" id="check_{{$objective->id}}" wire:model="pool.{{$objective->id}}">
                                        <div
                                        x-data="{ disabled: {{ $pool[$objective->id] ? 'false' : 'true' }} }"
                                        x-on:click="disabled = !disabled; updateCount(disabled)"
                                        :class="disabled ? 'text-gray-400 line-through' : 'text-emerald-800'"
                                        class="transition-all duration-100 select-none"
                                        >
                                        <span x-text="disabled ? '⚫' : '🟢'"></span>
                                        {{ $objective->description }}
                                    </div>
                                </label>
                            </div>
                            @endforeach
                        </div>
                        
                        <div class="bg-gray-100 rounded-lg shadow-inner p-1">
                            @foreach ($game->private_objectives as $objective)
                            <div class="border-b">
                                <label for="check_{{$objective->id}}">
                                        <input class="hidden" type="checkbox" id="check_{{$objective->id}}" wire:model="pool.{{$objective->id}}">
                                        <div
                                        x-data="{ disabled: {{ $pool[$objective->id] ? 'false' : 'true' }} }"
                                        x-on:click="disabled = !disabled; updateCount(disabled)"
                                        :class="disabled ? 'text-gray-400 line-through' : 'text-red-800'"
                                        class="transition-all duration-100"
                                        >
                                        <span x-text="disabled ? '⚫' : '🔴'"></span>
                                        {{ $objective->description }}
                                    </div>
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>