<div class="gap-4 flex justify-center">
    <div class="bg-gray-100 p-4 w-1/2">
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
