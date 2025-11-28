@extends('layouts.app')

@section('content')

@php
    $can_create_public_objectives = $game->creator_id == auth()->user()->id || auth()->user()->isAdmin();
@endphp

<div class="justify-center flex h-full">
    <form method="POST" action="/games/{{$game->id}}/objective" class="bg-white p-10 rounded-3xl" name="blbblbblblb">
        @csrf
        <div class="mb-5">
            <h1 class="text-3xl text-center font-bold mb-5">Ajout d'objectifs pour <a class="decoration-dotted underline" href="/games/{{$game->id}}">{{ $game->name }}</a></h1>
            <div class="text-center">
                @if ($can_create_public_objectives)
                    Tu es administrateur pour la gestion de ce jeu. Tu peux décider de la visibilité de cet objectif.
                @else
                    Tu ne peux créer que des objectifs privés.
                @endif
            </div>
        </div>
        <div id="rows" class="space-y-0.5 max-h-96 overflow-auto p-1">
            <div class="flex">
                <x-form.text-input name="objectives[]" class="w-full rounded-r-none" placeholder="Objectif"/>
                <x-form.select-input name="visibilities[]" class="w-24 rounded-l-none">
                    @if($can_create_public_objectives)
                        <option value="public">Public</option>
                    @endif
                    <option value="private">Privé</option>
                </x-form.select-input>
            </div>
        </div>

        <div class="mt-5 text-center">
            <x-form.submit-input>Je valide !</x-form.submit-input>
        </div>
    </form>
    <template id="rowTemplate">
        <div class="flex">
            <x-form.text-input name="objectives[]" class="rounded-r-none w-full" placeholder="Objectif"/>
            <x-form.select-input name="visibilities[]" class="w-24 rounded-l-none">
                <option value="public">Public</option>
                <option value="private">Privé</option>
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
