<x-main-panel>
    <p class="text-center text-xl py-2 dark:text-slate-200">
        {{ __('room.wait.teams.new_team.title') }}
    </p>
    <div class="space-y-5">
        <div class="flex flex-col">
            <x-form.label for="new_team_name">
                {{ __('room.wait.teams.new_team.name.label') }}
            </x-form.label>
            <x-form.text-input wire:model="new_team_name" placeholder="{{ __('room.wait.teams.new_team.name.placeholder') }}" name="new_team_name"/>
        </div>
        
        <div class="flex flex-col">
            <x-form.label for="new_team_color">{{ __('room.wait.teams.new_team.color.label') }}</x-form.label>
            <x-form.team-color-selector/>
        </div>
        
        <div class="flex flex-col">
            <x-form.label for="new_team_image">
                {{ __('room.wait.teams.new_team.image.label') }}
            </x-form.label>
            <x-form.filedrop-input wire:model="new_team_image" name="new_team_image" message="{{ __('room.wait.teams.new_team.image.message') }}"/>
            
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
                <x-form.button wire:click='new_team(false)'>
                    {{ __('room.wait.teams.new_team.create') }}
                </x-form.button>
                @if (!$user_team)
                    <x-form.button wire:click='new_team(true)'>
                        {{ __('room.wait.teams.new_team.create_and_join') }}
                    </x-form.button>
                @endif
            </div>
        </div>
    </div>
</x-main-panel>