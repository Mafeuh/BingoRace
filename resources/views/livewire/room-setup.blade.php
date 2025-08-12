<div>

    <h1 class="text-3xl text-center font-bold mb-3">
        {{ __('room.setup.title') }}
    </h1>
    
    <form action="/room/setup" method="POST" class="flex justify-center">
        @csrf
        <div class="space-y-2 xl:w-2/3">
            <div>
                <div class="lg:col-span-2 bg-white rounded-lg p-2 text-center">
                    <div class="text-xl font-bold mb-2">
                        {{ __('room.setup.settings.title') }}
                    </div>
                    <x-room-creation-settings></x-room-creation-settings>
                </div>
            </div>
            
            <div class="bg-white rounded-lg p-2">
                <livewire:games-objectives-selection :room_id="$room->id"/>
            </div>
            
            <div class="text-center pt-5">
                <input type="hidden" name="room_id" value="{{ $room->id }}">
                <x-form.submit-input :disabled="$can_start">
                    <span class="font-bold">
                        {{ __('room.setup.submit') }}
                    </span>
                </x-form.submit-input>
            </div>
        </div>
    </form>
</div>