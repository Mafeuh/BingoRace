@props(['value', 'name'])

<button
    @isset($value)
        value="{{$value}}"
    @endisset
    @isset($name)
        name="{{$name}}"
        id="{{$name}}"
    @endisset
    class="
        px-3 py-1 text-xl bg-green-300 hover:bg-green-400 border-green-400 border-2 text-white rounded-3xl transition-all"
    type="submit">{{ $slot }}</button>
