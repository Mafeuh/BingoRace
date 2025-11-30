<button x-cloak {{ $attributes->merge([
    'class' => "px-2 py-1 bg-blue-300 hover:bg-blue-400 dark:bg-blue-900 
    dark:hover:bg-blue-700 text-lg rounded-full dark:text-gray-200 dark:shadow dark:shadow-blue-500
    disabled:bg-gray-300 disabled:text-gray-500
    disabled:dark:bg-blue-900"
]) }}>
    {{ $slot }}
</button>