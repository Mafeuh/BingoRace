<div class="grid grid-cols-2 gap-4">
    <div class="bg-gray-100 p-4">
        <h2 class="text-xl">
            {{ __('room.setup.settings.grid.title') }}
        </h2>
        <div class="grid sm:grid-cols-2">
            <div>
                <x-form.label for="grid_width">
                    {{ __('room.setup.settings.grid.width') }}
                </x-form.label>
                <x-form.number-input name="grid_width" min="1" max="10" value="5"/>
            </div>

            <div>
                <x-form.label for="grid_height">
                    {{ __('room.setup.settings.grid.height') }}
                </x-form.label>
                <x-form.number-input name="grid_height" min="1" max="10" value="5"/>
            </div>
        </div>
    </div>

    <div class="bg-gray-100 p-4">
        <h2 class="text-xl">
            {{ __('room.setup.settings.max_teams.title') }}
        </h2>
        <div>
            <i>
                {{ __('room.setup.settings.max_teams.description1') }}
            </i>
        </div>
        <div>
            <i>
                {{ __('room.setup.settings.max_teams.description2') }}
            </i>
        </div>

        <div>
            <x-form.number-input name="max_teams_per_square" min="0"/>
        </div>

    </div>
</div>
