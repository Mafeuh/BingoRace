<div class="bg-white p-3 rounded-l-full">
    <img src="{{ auth()->user()->image_url }}" alt="">
    <span class="text-xl font-bold">
        {{ auth()->user()->name }}
    </span>
</div>