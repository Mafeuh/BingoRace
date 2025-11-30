@extends('layouts.app')

@section('page_title') {{ __('game.objectives.edit') }} @endsection

@section('content')
<div class="justify-center flex">
    <x-main-panel class="w-96">
        <form method="POST" action="/objectives/{{ $objective->id }}/edit_post" name="blbblbblblb">
            @csrf
    
            <div class="flex flex-col">
                <x-form.label for="description">Description</x-form.label>
                <x-form.textbox-input name="description">
                    {{ $objective->description }}
                </x-form.textbox-input>
            </div>
    
    
            <div class="mt-5 text-center">
                <x-form.button type="submit">Je valide !</x-form.button>
            </div>
        </form>
    </x-main-panel>
</div>
@endsection
