@extends('layouts.app')

@section('page_title') {{ __('game.objectives.new.page_title', ['name' => $game->name]) }} @endsection

@section('content')

@php
    $can_create_public_objectives = $game->creator_id == auth()->user()->id || auth()->user()->isAdmin();
@endphp

<div class="justify-center flex">
    <x-main-panel class="rounded">
        <form method="POST" action="/games/{{$game->id}}/objective" name="blbblbblblb">
            @csrf
            <div class="mb-5 mx-auto w-96 dark:text-gray-200 space-y-2">
                <div>
                    @if ($can_create_public_objectives)
                        {{ __('game.objectives.new.can_create_public') }}
                    @else
                        {{ __('game.objectives.new.cannot_create_public') }}
                    @endif
                </div>
                <div>
                    {{ __('game.objectives.difficulty') }}
                </div>
                <div>
                    {{ __('game.objectives.difficulty.default') }}
                </div>
            </div>
            <div id="rows" class="space-y-0.5 max-h-96 overflow-auto p-1">
                <div class="flex">
                    <x-form.text-input name="objectives[]" class="w-96 rounded-r-none" placeholder="Objectif"/>
                    <x-form.number-input name="difficulties[]" class="w-28 rounded-none" min="1" max="3" placeholder="{{ __('game.objectives.difficulty.placeholder') }}"/>
                    <x-form.select-input name="visibilities[]" class="w-24 rounded-l-none">
                        @if($can_create_public_objectives)
                            <option value="public">
                                {{ __('game.objectives.visibility.public') }}
                            </option>
                        @endif
                        <option value="private">
                            {{ __('game.objectives.visibility.private') }}
                        </option>
                    </x-form.select-input>
                </div>
            </div>
    
            <div class="mt-5 text-center">
                <x-form.submit-input>Je valide !</x-form.submit-input>
            </div>
        </form>
    </x-main-panel>

    <template id="rowTemplate">
        <div class="flex">
            <x-form.text-input name="objectives[]" class="w-96 rounded-r-none" placeholder="Objectif"/>
            <x-form.number-input name="difficulties[]" class="w-28 rounded-none" min="1" max="3" placeholder="{{ __('game.objectives.difficulty.placeholder') }}"/>
            <x-form.select-input name="visibilities[]" class="w-24 rounded-l-none">
                @if($can_create_public_objectives)
                    <option value="public">
                        {{ __('game.objectives.visibility.public') }}
                    </option>
                @endif
                <option value="private">
                    {{ __('game.objectives.visibility.private') }}
                </option>
            </x-form.select-input>
        </div>
    </template>
    <script>
        const template = document.getElementById('rowTemplate');
        const container = document.getElementById('rows');

        function addRow() {
            const clone = document.importNode(template.content, true);
            container.appendChild(clone);
            updateLastInputHandler();
        }

        function updateLastInputHandler() {
            const allInputs = container.querySelectorAll('input[type="text"]');

            // On supprime l'écouteur sur tous
            allInputs.forEach(input => {
                input.removeEventListener('click', addRow);
                input.removeEventListener('focus', addRow);
            });

            // On met l'écouteur sur le dernier SEULEMENT
            const last = allInputs[allInputs.length - 1];
            if (last) {
                last.addEventListener('click', addRow);
                last.addEventListener('focus', addRow);
            }
        }

        // Initialisation : mettre l'écouteur sur le premier input
        updateLastInputHandler();
    </script>

</div>
@endsection
