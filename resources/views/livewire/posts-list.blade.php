<div class="max-h-[70vh] overflow-y-auto pr-2 space-y-4">
    @forelse ($posts as $post)
        <div @class([
            'w-full p-2 shadow-inner shadow-gray-300 bg-gray-50',
            'opacity-50' => $post->hidden
        ])>
            <div>
                <h1 
                    @class([
                        'inline font-bold transition-all',
                        'text-emerald-700' => !$post->hidden,
                        'text-gray-400' => $post->hidden,
                    ])
                class="inline text-emerald-700 font-bold">
                @if ($post->hidden)
                    {{ __('posts.is_hidden') }}
                @endif
                {{ $post->title }}
                </h1>
                <span class="text-gray-400 text-sm">
                    - {{ $post->author->name }}
                </span>
            </div>
            <div class="text-gray-400 text-xs flex gap-2">
                <span>
                    {{ \Carbon\Carbon::parse($post->created_at)->format('M d Y') }}
                </span>
                @admin()
                    <a href="{{ route('posts.edit', ['post' => $post->id]) }}" class="p-1 bg-emerald-500 rounded">
                        <x-icon.pencil/>
                    </a>
                    <button wire:click="switch_state({{ $post }})">
                        @if ($post->hidden)
                            <x-icon.eye-hidden/>
                        @else
                            <x-icon.eye-show/>
                        @endif
                    </button>
                @endadmin
            </div>
            <hr class="my-2">
            <div class="text-sm">
                {!! $post->description !!}
            </div>
        </div>
    @empty
        <div class="text-center text-red-500">
            {{ __('home.posts.empty') }}
        </div>
    @endforelse
</div>