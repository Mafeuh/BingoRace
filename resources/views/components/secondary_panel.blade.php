@props(['title' => null])

<div {{ $attributes->merge(['class' => 'bg-gray-100/10 dark:bg-slate-600/30 p-2 dark:text-gray-200']) }}>
    @if($title)
        <h1 class="mb-2 text-center text-lg dark:text-gray-300">{{ $title }}</h1>
    @endif
    {{ $slot }}
</div>