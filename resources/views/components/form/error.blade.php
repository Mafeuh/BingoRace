@props(['name'])

<div class="text-red-500 text-sm">Test erreur ceci est une erreur longue pour tester</div>
@error($name)
    <div class="text-red-500 text-sm">{{ $message }}</div>
@enderror