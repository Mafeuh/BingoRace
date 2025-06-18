<div class="grid grid-cols-2 space-x-4">
    <div class="bg-green-50 p-4">
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

    <div class="bg-green-50 p-4">
        <h2 class="text-xl">
            {{ __('room.setup.settings.objectives.title') }}
        </h2>
        <div class="grid grid-cols-3 text-left">
            <label for="public_objectives" class="col-span-2">
                {{ __('room.setup.settings.objectives.public') }}
            </label>
            <input type="checkbox" name="objective_type[]" id="public_objectives" value="public" checked>

            <label for="private_objectives" class="col-span-2">
                {{ __('room.setup.settings.objectives.private') }}
            </label>
            <input type="checkbox" name="objective_type[]" id="private_objectives" value="private" checked>
        </div>
    </div>
</div>
