@props([
    'placeholder' => '',
    'value' => '',
    'name',
    'required' => null,
    'wire_model' => null,
    'maxlength' => null,
    'minlength' => null
])

<input 
    type="text" 
    placeholder="{!!$placeholder!!}" 
    value="{{$value}}" 
    name="{{$name}}" 
    id="{{$name}}"
    @if ($wire_model != null)
    wire:model="{{$wire_model}}"
    @endif

    @isset($minlength)
        minlength="{{$minlength}}"
    @endisset
    @isset($maxlength)
        maxlength="{{$maxlength}}"
    @endisset

    @required($required != null)
    class="border-1 border-gray-200 rounded-full text-center py-3"
/>
