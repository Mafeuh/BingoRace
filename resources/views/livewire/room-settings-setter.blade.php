<x-main-panel class="w-full text-center flex flex-col justify-center items-center">

    <h2 class="text-xl text-blue-500 font-bold">
        {{ __('room.setup.settings.title') }}
    </h2>
    
    <x-secondary_panel>
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
                    <x-form.number-input id="max_teams" wire:model="max_teams" min="0" max="100" >
                    </x-form.number-input>
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
    </x-secondary_panel>
    
    <div class="mt-4 text-xl dark:text-gray-200">
        {{ __('room.wait.start.label') }}
        <span class="text-blue-500 font-bold">
            {{ __('room.wait.start.button') }}
        </span>
    
        <form action="{{ route('room-start') }}" method="POST" class="text-center">
            @csrf
            <x-form.button type="submit">
                {{ __('room.wait.start.button') }}
            </x-form.button>
        </form>
    </div>
</x-main-panel>
{{-- 
<div class="bg-white w-full rounded-xl p-2 text-center flex flex-col justify-center items-center">
</div> --}}
