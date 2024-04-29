@props([
    'placeholder' => '',
    'value' => '',
    'name',
])

<input type="text" placeholder="{!!$placeholder!!}" value="{{$value}}" name="{{$name}}" id="{{$name}}"
    class="border-1 border-gray-200 rounded-full text-center py-3"
/>
