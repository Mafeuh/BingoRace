<a href="/profile" class="bg-white p-3 rounded-l-full block">
    <img src="{{ auth()->user()->image_url }}" alt="">
    <span class="text-lg font-bold">
        {{ auth()->user()->name }}
    </span>
</a>