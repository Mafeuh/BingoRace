<select {{ $attributes->merge(['class' => "border-1 border-gray-200 rounded-full dark:text-white dark:bg-black/20 dark:border-black/30 text-center py-2 pl-2 pr-10"]) }}>
    {{ $slot }}
</select>
