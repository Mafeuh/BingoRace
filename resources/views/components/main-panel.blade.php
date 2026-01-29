<div {{ $attributes->merge([
    'class' => "bg-black/10 dark:bg-white/5 border border-white/20 p-2 select-none backdrop-blur-md"
    ]) }}>
    {{ $slot }}
</div>