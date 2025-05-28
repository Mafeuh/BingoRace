@extends('layouts.app')

@section('content')
<div class="h-full flex items-center justify-center">

    <div class="bg-green-100 mx-20 px-20 py-10 rounded-3xl shadow-lg shadow-green-300">
        <h1 class="text-3xl font-bold text-center">{{ __('Register') }}</h1>
        
        <form method="POST" action="/register" class="flex justify-center items-center">
            @csrf
            <div class="flex-col space-y-2 border-t-2 pt-5 mt-3 border-green-600">

                <!-- Name -->
                <div class="flex flex-col">
                    <x-form.label for="name">Pseudo</x-form.label>
                    <x-form.text-input name="name" required="" :value="old('name')" placeholder="Ton pseudo"/>
                    <x-form.error name="name"/>
                </div>
                
                <!-- Email Address -->
                <div class="flex flex-col">
                    <x-form.label for="email">E-mail</x-form.label>
                    <x-form.email-input name="email" required="" :value="old('email')" placeholder="Ton adresse mail"/>
                    <x-form.error name="email"/>
                </div>
                
                <!-- Password -->
                <div class="flex flex-col">
                    <x-form.label for="password">Mot de passe</x-form.label>
                    <x-form.password-input name="password" required="" placeholder="Mot de passe"/>
                    <x-form.error name="password"/>
                </div>
                
                <!-- Confirm Password -->
                <div class="flex flex-col">
                    <x-form.label for="password_confirmation">Confirmer</x-form.label>
                    <x-form.password-input name="password_confirmation" required="" placeholder="Confirmer le mot de passe"/>
                    <x-form.error name="password_confirmation"/>
                </div>
                
                <div class="text-center">
                    <x-form-validation>S'inscrire !</x-form-validation>
                </div>
            </div>
            
        </form>
    </div>
</div>
@endsection
