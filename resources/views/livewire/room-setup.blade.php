<x-main-panel>
    <div>
        <livewire:games-objectives-selection :room_id="$room->id"/>
    </div>
    
    <div class="text-center pt-5">
        <input type="hidden" name="room_id" value="{{ $room->id }}">
        
        <x-form.button wire:click="submit()">
            {{ __('room.setup.submit') }}
        </x-form.button>
    </div>
</x-main-panel>