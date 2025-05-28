@props([
    'name',
    'checked' => false,
    'wire_model' => null
])

<input 
    @class([
        'active:bg-green-500',
        'checked:bg-green-500', 
        'font-bold' => true])
    type="checkbox" 
    name="{{ $name }}" 
    id="{{ $name }}"
    @checked($checked)
    @if ($wire_model != null)
        wire:model="{{ $wire_model }}"
    @endif>