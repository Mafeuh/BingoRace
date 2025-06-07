@extends('layouts.app')

@section('content')
<div class="h-full flex items-center justify-center">
    <div class="bg-white p-10 rounded-3xl shadow-lg shadow-white">
        <h1 class="text-3xl font-bold text-center">{{ __('Connexion') }}</h1>
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />
    
        <form method="POST" action="/login" class="flex justify-center items-center">
            @csrf
            <div class="flex-col space-y-2 border-t-2 pt-5 mt-3 border-green-600">
                <!-- Email Address -->
                <div class="flex flex-col">
                    <x-form.label for="email">E-mail</x-form.label>
                    <x-form.email-input name="email" required :value="old('email')" placeholder="Adresse mail"/>
    
                    @error('email')
                        <div>{{ $message }}</div>
                    @enderror
                </div>
    
                <!-- Password -->
                <div class="flex flex-col">
                    <x-form.label for="password">Mot de passe</x-form.label>
                    <x-form.password-input name="password" required :value="old('password')" placeholder="Mot de passe"/>
    
                    @error('password')
                        <div>{{ $message }}</div>
                    @enderror
                </div>
    
    
                <div class="text-center">
                    <label for="remember_me" class="pr-5 align-middle col-span-2">Rester connecté ?</label>
                    <x-form.checkbox-input name="remember_me"/>
                </div>
    
                <div class="text-center">
                    <x-form-validation>Se connecter</x-form-validation>
                </div>
    
                <div class="text-center">
                    Pas de compte ? <a href="/register" class="text-green-600 font-bold">Inscris-toi !</a>
                </div>
            </div>
    
        {{-- <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                {{ __('Forgot your password?') }}
            </a>
            @endif
    
            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
            </div> --}}
        </form>
    </div>
</div>
@endsection
