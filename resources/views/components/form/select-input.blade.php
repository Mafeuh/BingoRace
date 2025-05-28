@props(['name', 'required' => null, 'wire_model' => null])

<select 
    name="{{ $name }}" 
    id="{{ $name }}" 
    @if ($wire_model != null)
        wire:model="{{$wire_model}}"
    @endif
    class="border-1 border-gray-200 rounded-full text-center py-3"
    @required($required != null)>
    {{ $slot }}
</select>
