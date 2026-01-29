@extends('layouts.app')

@section('page_title') {{ __('room.wait.title') }} @endsection

@section('content')
<div class="max-w-6xl mx-auto">
    <div>
        <h2 class="text-lg text-center dark:text-gray-200">
            {{ __('room.wait.code.label') }}
            <span class="text-2xl" x-data="{ show: false }" x-on:click="show = !show">
                <span x-show="!show" class="bg-gray-700 text-white rounded-md">
                    {{ __('room.wait.code.reveal') }}
                </span>
                <span x-show="show" class="font-bold">{{ $room->code }}</span>
            </span>
            <button class="bg-white dark:bg-slate-800 shadow-xl rounded-full py-2 px-4" onclick="copyText()" id="copy_button">
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
        <div class="space-y-5 w-1/3 text-sm">
            <livewire:teams-list :room="$room" />
    
            <livewire:team-creation-form :room="$room" />
        </div>
        
        <div class="w-2/3">
            <x-secondary_panel class="m-2 rounded">
                <div class="font-bold text-blue-500">
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
            </x-secondary_panel>

            @if (auth()->check() && auth()->user()->id == $room->creator_id)
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
