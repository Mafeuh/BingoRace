<div class="border-2 border-green-300 rounded-2xl">
    <div class="bg-green-200 rounded-t-xl border-b-2 border-green-300 p-0.5">
        <h1 class="text-xl">
            {{ $game->name }}
        </h1>
    </div>

    <div class="p-2">
        <div>
            <h2>
                {{ __('room.setup.game.public_objectives.label', [
                    'amount' => sizeof($selected_public_objectives)
                ]) }}
            </h2>

            <ul class="overflow-y-scroll max-h-48 divide-y divide-solid divide-gray-300">
                @foreach ($game->public_objectives as $objective)
                    <li 
                        @class([
                            'text-xs text-left m-0.5', 
                            'text-gray-500 line-through' => !$selected_public_objectives->contains($objective)
                        ])>
                        {{ $objective->description }}
                    </li>
                @endforeach
            </ul>
        </div>

        <div>
            <h2>
                {{ __('room.setup.game.private_objectives.label', [
                    'amount' => sizeof($selected_private_objectives)
                ]) }}
            </h2>
            
            <ul class="overflow-y-scroll max-h-48 divide-y divide-solid divide-gray-300">
                @foreach ($game->private_objectives as $objective)
                    <li 
                        @class([
                            'text-xs text-left m-0.5', 
                            'text-gray-500 line-through' => !$selected_private_objectives->contains($objective)
                        ])>
                        {{ $objective->description }}
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
