<div class="space-y-2" 
     x-data="{
        count: {{ $pool_size }},
        max_easy: {{ $max_easy }},
        max_medium: {{ $max_medium }},
        max_hard: {{ $max_hard }},
        width: @entangle('width'),
        height: @entangle('height'),
        nb_easy: @entangle('nb_easy'),
        nb_medium: @entangle('nb_medium'),
        nb_hard: @entangle('nb_hard'),
        choose_difficulty_amount: @entangle('choose_difficulty_amount'),
        not_enough_selection: false,
        not_enough_difficulty: false,
        
        updateCount(is_disabled, difficulty) {
            this.count += is_disabled ? -1 : 1;

            if(difficulty == 1) {
                this.max_easy += is_disabled ? -1 : 1;
            } else if(difficulty == 2) {
                this.max_medium += is_disabled ? -1 : 1;
            } else if(difficulty == 3) {
                this.max_hard += is_disabled ? -1 : 1;
            }
            this.checkValidity();
        },

        checkValidity() {
            this.not_enough_selection = this.width * this.height > this.count;
            if(this.choose_difficulty_amount) {
                this.not_enough_difficulty = this.width * this.height != this.nb_easy + this.nb_medium + this.nb_hard;
            } else {
                this.not_enough_difficulty = false;
            }
            if(this.not_enough_selection || this.not_enough_difficulty) {
                $wire.
            }
        },

        init() {
            // Exécute au chargement initial
            this.checkValidity();
    
            // Surveille les changements de width et height venant de Livewire
            this.$watch('width', () => this.checkValidity());
            this.$watch('height', () => this.checkValidity());
            // Surveille count si des éléments sont ajoutés/supprimés par d'autres moyens
            this.$watch('count', () => this.checkValidity());

            this.$watch('nb_easy', () => this.checkValidity());
            this.$watch('nb_medium', () => this.checkValidity());
            this.$watch('nb_hard', () => this.checkValidity());

            this.$watch('choose_difficulty_amount', () => this.checkValidity());
        }
    }"
    x-init="checkValidity()">

    <div class="flex justify-center">
        <x-secondary_panel :title="__('room.setup.settings.grid.title')">
            <div class="grid sm:grid-cols-2">
                <div class="text-center">
                    <x-form.label for="grid_width">
                        {{ __('room.setup.settings.grid.width') }}
                    </x-form.label>
                    <x-form.number-input class="w-32" wire:model.live.debounce.250ms="width" name="grid_width"/>
                </div>
    
                <div class="text-center">
                    <x-form.label for="grid_height">
                        {{ __('room.setup.settings.grid.height') }}
                    </x-form.label>
                    <x-form.number-input class="w-32" wire:model.live.debounce.250ms="height" name="grid_height"/>
                </div>
            </div>
        </x-secondary_panel>
    </div>

    <div>
        <div class="text-lg text-center text-blue-500">
            {{ __('room.setup.objectives_pool.repartition') }}
        </div>
        <x-games-repartition-slider :pool_size="$pool_size" :height="$height" :width="$width" :room="$room"/>
    </div>

    <div class="text-center justify-center" x-data="{ show_form: false }">
        <div class="text-lg text-center text-blue-500">
            <label for="show_form_input">
                {{ __('room.setup.objectives_pool.difficulty.title') }} ?
            </label>
            <input id="show_form_input" type="checkbox" x-model="show_form" wire:model="choose_difficulty_amount"/>
        </div>
        <div x-show="show_form">
            <table class="mx-auto text-sm">
                <tr class="text-blue-500">
                    <th>{{ __('room.setup.objectives_pool.difficulty.easy') }}</th>
                    <th>{{ __('room.setup.objectives_pool.difficulty.medium') }}</th>
                    <th>{{ __('room.setup.objectives_pool.difficulty.hard') }}</th>
                </tr>
                <tr class="dark:text-gray-200">
                    <td>
                        <input type="number" class="w-24 p-0.5 rounded bg-gray-200 dark:bg-slate-800 border-0" 
                               wire:model.live="nb_easy" min="1" :max="max_easy"/>
                    </td>
                    <td>
                        <input id="nb_medium_input" type="number" class="w-24 p-0.5 rounded bg-gray-200 dark:bg-slate-800 border-0" 
                               wire:model.live="nb_medium" min="1" :max="max_medium"/>
                    </td>
                    <td>
                        <input id="nb_hard_input" type="number" class="w-24 p-0.5 rounded bg-gray-200 dark:bg-slate-800 border-0" 
                               wire:model.live="nb_hard" min="1" :max="max_hard"/>
                    </td>
                </tr>
                <tr class="italic dark:text-gray-200">
                    <td>Max: <span x-text="max_easy"></span></td>
                    <td>Max: <span x-text="max_medium"></span></td>
                    <td>Max: <span x-text="max_hard"></span></td>
                </tr>
            </table>
            <div x-show="not_enough_difficulty" class="text-sm text-red-600 dark:text-red-400">
                {{ __('room.setup.settings.errors.difficulty') }}
            </div>
        </div>
    </div>
    
    <div>
        <div class="text-lg text-center text-blue-500">
            {{ __('room.setup.objectives_pool.title') }}
        </div>
        <div class="text-center italic dark:text-gray-200">
            {{ __('room.setup.objectives_pool.greyed') }}
        </div>

        <div 
            class="text-center" 
            :class="{ 
                'dark:text-gray-200': !not_enough_selection,
                'dark:text-red-400 text-red-600': not_enough_selection }">
            <span x-text="count"></span> / <span x-text="width * height"></span>
            <span class="italic" x-show="not_enough_selection">
                {{ __('room.setup.settings.errors.selection') }}
            </span>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 gap-1">
            @foreach ($room->games as $game)
            <div class="relative" style="padding-bottom: 100%">
                <div @class([
                    'absolute w-full h-full rounded flex flex-col',
                    'bg-red-300 dark:bg-red-950' => $loop->odd,
                    'bg-blue-300 dark:bg-blue-950' => $loop->even,
                    ])>
                    <div class="p-2 justify-center dark:text-gray-200">
                        <h2 class="text-center text-xl">{{ $game->name }}</h2>
                    </div>
                    
                    <div class="flex-1 overflow-y-auto p-2 space-y-1 text-sm scrollbar-hidden">
                        <div class="bg-white dark:bg-slate-900 rounded-lg shadow-inner p-1">
                            @foreach ($game->public_objectives as $objective)
                            <div class="border-b">
                                <label x-data="{ disabled: {{ $pool_ids[$objective->id] ? 'false' : 'true' }} }">
                                    <input class="hidden" type="checkbox" wire:model="pool_ids.{{$objective->id}}"
                                           x-on:click="disabled = !disabled; updateCount(disabled, {{ $objective->difficulty }})">
                                    <div :class="disabled ? 'text-gray-400 line-through' : 'text-emerald-800'"
                                         class="transition-all duration-100 select-none overflow-hidden flex space-x-2 cursor-pointer"
                                         title="{{ $objective->description }}">
                                        <span x-text="disabled ? '⚫' : '🟢'"></span>
                                        <span>{{ $objective->difficulty }}</span>
                                        <span>{{ $objective->description }}</span>
                                    </div>
                                </label>
                            </div>
                            @endforeach
                        </div>
                        
                        <div class="bg-white dark:bg-gray-900 rounded-lg shadow-inner p-1">
                            @foreach ($game->private_objectives as $objective)
                            <div class="border-b">
                                <label x-data="{ disabled: {{ $pool_ids[$objective->id] ? 'false' : 'true' }} }">
                                    <input class="hidden" type="checkbox" wire:model="pool_ids.{{$objective->id}}"
                                           x-on:click="disabled = !disabled; updateCount(disabled, {{ $objective->difficulty }})">
                                    <div :class="disabled ? 'text-gray-400 line-through' : 'text-red-800'"
                                         class="transition-all duration-100 space-x-1 cursor-pointer">
                                        <span x-text="disabled ? '⚫' : '🔴'"></span>
                                        <span>{{ $objective->difficulty }}</span>
                                        <span>{{ $objective->description }}</span>
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