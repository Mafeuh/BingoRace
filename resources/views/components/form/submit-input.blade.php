@props(['value', 'name', 'disabled' => false])

<button 
    {{ $attributes->merge(['class' => 'px-5 py-2 text-xl bg-green-600 text-white rounded-3xl transition-all hover:bg-green-600 hover:font-bold hover:scale-105 disabled:bg-gray-300 disabled:text-gray-500 disabled:scale-100 disabled:cursor']) }}
    type="submit">
    {{ $slot }}
</button>
