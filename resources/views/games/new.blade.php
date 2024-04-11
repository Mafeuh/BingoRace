@extends('layouts.app')

@section('content')
    <div>
        <div class="text-2xl font-bold">Nouveau Jeu</div>

        <form action="/games/new" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="flex flex-col">
                <label for="name">Nom*: </label>
                <input type="text" name="name" id="name" class="w-1/4"/>
                @error("name")
                    <span class="col-start-2 text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col">
                <label for="image">Image</label>
                <input type="file" name="image" id="image" class="w-1/4"/>
                @error("image")
                    <span class="col-start-2 text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="mt-10">
                <x-form-validation>Valider</x-form-validation>
            </div>
        </form>
    </div>
@endsection
