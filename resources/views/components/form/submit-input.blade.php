@props(['value', 'name', 'disabled' => false])

<button 
    {{ $attributes->merge(['class' => 'px-5 py-2 text-xl 
        bg-blue-400 text-white rounded-3xl transition-all hover:bg-blue-600 
        disabled:bg-gray-300 
        dark:bg-blue-600 dark:hover:bg-blue-800
        disabled:text-gray-500 disabled:scale-100 disabled:cursor']) }}
    type="submit">
    {{ $slot }}
</button>
