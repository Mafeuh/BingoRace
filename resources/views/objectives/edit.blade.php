@extends('layouts.app')

@section('content')
<div class="justify-center flex h-full">
    <form method="POST" action="/objectives/{{ $objective->id }}/edit_post" class="bg-green-50 px-40 py-10 rounded-3xl" name="blbblbblblb">
        @csrf
        <div class="mb-5">
            <h1 class="text-3xl text-center font-bold mb-5">Modification d'un objectif</h1>
        </div>

        <div class="flex flex-col">
            <x-form.label for="description">Description</x-form.label>
            <x-form.textbox-input name="description" :value="$objective->description"/>
        </div>


        <div class="mt-5">
            <x-form.submit-input>Je valide !</x-form.submit-input>
        </div>
    </form>
</div>
@endsection
