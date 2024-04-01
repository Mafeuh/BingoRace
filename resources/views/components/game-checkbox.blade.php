@props(['game'])

<div id="game{{$game->id}}" class="
    transition-all text-center bg-green-50 py-5 text-xl mx-20 rounded-3xl
    hover:font-bold
    " x-data="{ checked: false }" @click="checked = !checked"
    x-bind:class="{ 'bg-green-300 scale-110': checked, 'hover:bg-green-200 hover:scale-110': !checked }">
    <input
        type="checkbox"
        class="hidden"
        name="game_checkboxes[]"
        value="{{ $game->id }}"
        x-bind:checked="checked">
    {{$game->name}}
</div>

{{-- {!! $game !!} --}}
