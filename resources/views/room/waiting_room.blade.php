@extends('layouts.app')

@section('content')
<div class="h-fit">
    <div class="h-fit gap-5 flex">
        <div class="space-y-5 w-1/3 text-sm">
            <div class="bg-white p-3 shadow-inner shadow-green-100 rounded-3xl h-fit">
                <livewire:teams-list :room="$room" />
            </div>
    
            <div class="bg-white p-3 shadow-inner shadow-green-100 rounded-3xl h-fit">
                <livewire:team-creation-form :room="$room" />
            </div>
        </div>

        <div class="w-1/2">
            <div>
                <h1 class="text-3xl text-center">
                    {{ __('room.wait.title') }}
                </h1>
                <h2 class="text-2xl text-center">
                    {{ __('room.wait.code.label') }}
                    <span x-data="{ show: false }" x-on:click="show = !show">
                        <span x-show="!show" class="bg-gray-700 text-white rounded-md">
                            {{ __('room.wait.code.reveal') }}
                        </span>
                        <span x-show="show" class="font-bold">{{ $room->code }}</span>
                    </span>
                    <button class="bg-white shadow-xl rounded-full py-2 px-4" onclick="copyText()" id="copy_button">
                        {{ __('room.wait.code.copy') }}
                    </button>
                    <script>
                        function copyText() {
                            const texte = "{{ $room->code }}";
                            navigator.clipboard.writeText(texte)
                                .then(() => document.getElementById('copy_button').innerText = "{{ __('room.wait.code.copied') }}");
                        }
                    </script>
                </h2>
            </div>

            <div class="bg-white m-5 p-5 rounded-xl">
                <div class="font-bold text-green-700">
                    {{ __('room.wait.rules.title') }}
                </div>
                <div>
                    {{ __('room.wait.rules.description1', ['amount' => $room->grid->height * $room->grid->width]) }}
                </div>
                <div>
                    {{ __('room.wait.rules.description2') }}
                </div>
                <div class="mt-5">
                    {{ __('room.wait.rules.description3') }}
                </div>
            </div>

            @if (auth()->user()->id == $room->creator_id)
                <livewire:room-settings-setter :room="$room"/>
            @endif
        </div>
    </div>
</div>
@endsection
