<div class="bg-white w-full rounded-xl p-2 text-center flex flex-col justify-center items-center">
    <h2 class="text-xl text-green-700 font-bold">
        {{ __('room.setup.settings.title') }}
    </h2>

    <div class="p-2 border w-fit rounded-lg shadow-inner">
        <table>
            <tr>
                <td>
                    {{ __('room.wait.timer.label') }}
                </td>
                <td class="w-36"></td>
                <td class="pl-16">
                    <livewire:room-timer-setter :room="$room"/>
                </td>
            </tr>

            <tr>
                <td colspan="3" class="italic text-sm">
                    <div>
                        {{ __('room.wait.timer.description1') }}
                    </div>
                    <div>
                        {{ __('room.wait.timer.description2') }}
                    </div>
                </td>
            </tr>

            <tr>
                <td>
                    {{ __('room.setup.settings.max_teams.title') }}
                </td>
                <td></td>
                <td class="pl-16">
                    <input id="max_teams" type="number" wire:model="max_teams" min="0" max="100" class="p-2 border-gray-300 rounded-full w-16 focus:outline-none"/>
                </td>
            </tr>

            <tr>
                <td colspan="3" class="italic text-sm">
                    <div>
                        {{ __('room.setup.settings.max_teams.description1') }}
                    </div>
                    <div>
                        {{ __('room.setup.settings.max_teams.description2') }}
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <div class="mt-4 text-xl">
        {{ __('room.wait.start.label') }}
        <span class="text-green-800 font-bold">
            {{ __('room.wait.start.button') }}
        </span>

        <form action="{{ route('room-start') }}" method="POST" class="text-center">
            @csrf
            <button class="text-xl bg-green-500 px-5 py-3 rounded-full font-bold hover:bg-green-700 active:animate-ping" type="submit">
                {{ __('room.wait.start.button') }}
            </button>
        </form>
    </div>
</div>
