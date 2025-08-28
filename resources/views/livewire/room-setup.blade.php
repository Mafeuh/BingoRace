<div>
    <h1 class="text-3xl text-center font-bold mb-3">
        {{ __('room.setup.title') }}
    </h1>

    <div class="justify-center">
        <div class="space-y-2">
            <div class="bg-white rounded-lg p-2">
                <livewire:games-objectives-selection :room_id="$room->id"/>
            </div>
            
            <div class="text-center pt-5">
                <input type="hidden" name="room_id" value="{{ $room->id }}">
                <button wire:click="submit()" class="px-5 py-2 text-xl bg-green-600 text-white rounded-3xl transition-all font-bold
                hover:bg-green-600 hover:font-bold hover:scale-105 disabled:bg-gray-300 disabled:text-gray-500 disabled:scale-100 disabled:cursor" type="submit">
                    {{ __('room.setup.submit') }}
                </button>
            </div>
        </div>
    </div>
</div>