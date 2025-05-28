@props([
    'disabled',
])

<div>
    <div>
        <label for="timer_value">Durée de la partie</label>
        <input 
            type="time"
            @disabled($disabled)
            class="border-1 border-gray-200 rounded-full text-center py-3"
            wire:model.live="timer_value"/>
    </div>
    <div class="italic">Exemple: 01:30 correspond à 1h30</div>
    <div class="italic">00:00 pour ne pas mettre de timer</div>
</div>