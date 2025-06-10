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
        px-5 py-2 text-xl animate-pulse bg-green-400 text-white rounded-3xl transition-all
        hover:bg-green-600 hover:font-bold hover:scale-105"
    type="submit">{{ $slot }}</button>
