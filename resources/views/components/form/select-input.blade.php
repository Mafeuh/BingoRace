<select {{ $attributes->merge(['class' => "border-1 border-gray-200 rounded-full text-center py-3 pl-2 pr-10"]) }}>
    {{ $slot }}
</select>
