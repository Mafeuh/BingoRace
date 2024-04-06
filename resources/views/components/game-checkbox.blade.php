@props(['game'])

<div id="game{{$game->id}}" class="
    transition-all text-center bg-green-50 py-5 text-xl mx-20 rounded-3xl
    " x-data="{ checked: false }" x-on:click="checked = !checked"
    x-bind:class="{ 'bg-green-500 scale-110 font-bold': checked, 'hover:bg-green-200 hover:scale-110 hover:font-bold': !checked }">
    <input
        type="checkbox"
        class="hidden"
        name="game_checkboxes[]"
        value="{{ $game->id }}"
        x-bind:checked="checked">
    {{$game->name}}
</div>

{{-- {!! $game !!} --}}
