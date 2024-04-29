@props(['name'])

<select name="{{ $name }}" id="{{ $name }}" class="border-1 border-gray-200 rounded-full text-center py-3">
    {{ $slot }}
</select>
