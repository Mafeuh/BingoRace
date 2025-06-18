@props([
    'disabled',
])

<div>
    <div>
        <label for="timer_value">
            {{ __('room.wait.timer.label') }}
        </label>
        <input 
            type="time"
            @disabled($disabled)
            class="border-1 border-gray-200 rounded-full text-center py-3"
            wire:model.live="timer_value"/>
    </div>
    <div class="italic">
        {{ __('room.wait.timer.description1') }}
    </div>
    <div class="italic">
        {{ __('room.wait.timer.description2') }}
    </div>
</div>