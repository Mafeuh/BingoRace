<button x-cloak {{ $attributes->merge([
    'class' => "bg-blue-400/90 dark:bg-blue-700/90 px-4 py-2 rounded-lg text-slate-200"
]) }}>
    {{ $slot }}
</button>