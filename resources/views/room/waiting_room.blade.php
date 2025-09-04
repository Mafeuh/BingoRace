@extends('layouts.app')

@section('content')
<div class="h-fit">
    <div>
        <h1 class="text-2xl text-center text-emerald-800">
            {{ __('room.wait.title') }}
        </h1>
        <h2 class="text-lg text-center">
            {{ __('room.wait.code.label') }}
            <span class="text-2xl" x-data="{ show: false }" x-on:click="show = !show">
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
    
    <div class="h-fit gap-5 sm:flex">
        <div class="space-y-5 sm:w-1/3 text-sm">
            <div class="bg-white p-3 shadow-inner shadow-green-100 rounded-3xl h-fit">
                <livewire:teams-list :room="$room" />
            </div>
    
            <div class="bg-white p-3 shadow-inner shadow-green-100 rounded-3xl h-fit">
                <livewire:team-creation-form :room="$room" />
            </div>
        </div>

        <div class="sm:w-2/3 lg:w-1/2">
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const roomId = {{ $room->id }};
            const channelName = `room.${roomId}`;

            let channel = window.Echo.channel(channelName);

            channel.listen('.room-started', (event) => {
                window.location.href = "/room/play";
            });

            channel.listen('.team-created', (event) => {
                Livewire.dispatch('refreshTeamList', event);
            });

            channel.listen('.team-joined', (event) => {
                Livewire.dispatch('refreshTeamList', event);
            });

            channel.listen('.team-left', (event) => {
                Livewire.dispatch('refreshTeamList', event);
            });

            channel.listen('.team-deleted', (event) => {
                Livewire.dispatch('refreshTeamList', event);
            });
        });
    </script>
</div>
@endsection
