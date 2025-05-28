@props(['name'])

@error($name)
    <div class="text-red-500 text-sm">{{ $message }}</div>
@enderror