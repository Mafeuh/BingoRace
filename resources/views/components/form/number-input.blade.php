@props([
    'placeholder' => '',
    'value' => '',
    'name',
    'required' => null,
    'wire_model' => null,
    'min' => null,
    'max' => null,
    'step' => null
])

<input 
    type="number" 
    placeholder="{!!$placeholder!!}" 
    value="{{$value}}" 
    name="{{$name}}" 
    id="{{$name}}"
    @if ($wire_model != null)
        wire:model="{{$wire_model}}"
    @endif
    @required($required != null)
    @isset($min)
        min="{{$min}}"
    @endisset
    @isset($max)
        max="{{$max}}"
    @endisset
    @isset($step)
        step="{{$step}}"
    @endisset
    class="border-1 border-gray-200 rounded-full text-center py-3"
/>
