<select {{ $attributes->merge(['class' => "border-1 border-gray-200 rounded-full dark:text-white dark:bg-slate-800 dark:border-slate-900 text-center py-2 pl-2 pr-10"]) }}>
    {{ $slot }}
</select>
