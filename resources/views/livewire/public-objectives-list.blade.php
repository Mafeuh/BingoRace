<div class="bg-white p-2 rounded-3xl">
    <h2 class="text-xl text-center mb-1">
        {{ __('game.show.public_objectives.title', ['amount' => sizeof($public_objectives)]) }}
        @if ($can_manage_public_objectives)
            <span>
                <a href="/games/{{$game->id}}/objective"
                    class="bg-green-500 p-1 rounded-full hover:bg-green-600 text-sm">➕</a>
            </span>
        @endif
    </h2>
    @if(sizeof($public_objectives) > 0)
        <div class="grid grid-cols-1 xl:grid-cols-2 gap-2">
            @foreach ($public_objectives as $pub_obj)
                <div class="relative bg-gray-100 p-1 text-center rounded-xl">
                    @admin()
                        <a class="absolute left-2" href="/objectives/{{$pub_obj->id}}/delete">👉</a>
                    @endadmin
                    @if ($can_manage_public_objectives)
                        <a class="absolute right-5" href="/objectives/{{$pub_obj->id}}/delete">❌</a>
                        <a class="absolute right-10" href="/objectives/{{$pub_obj->id}}/edit">✏️</a>
                    @endif
                    <div @class(['pr-14' => $can_manage_public_objectives])>
                        <span>
                            {{$pub_obj->description}}
                        </span>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center">
            {{ __('game.show.public_objectives.empty') }}
        </div>
    @endif

</div>