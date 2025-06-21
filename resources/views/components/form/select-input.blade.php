@props(['name', 'required' => null, 'wire_model' => null])

<select 
    {{ $attributes->merge(['class' => "border-1 border-gray-200 rounded-full text-center py-3"]) }}
    name="{{ $name }}" 
    id="{{ $name }}" 
    @if ($wire_model != null)
        wire:model="{{$wire_model}}"
    @endif

    @required($required != null)>
    {{ $slot }}
</select>
