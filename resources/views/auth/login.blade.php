@extends('layouts.app')

@section('content')
<div class="bg-green-100 mx-20 p-10 rounded-3xl shadow-lg shadow-green-300">
    <h1 class="text-3xl font-bold text-center">{{ __('Connexion') }}</h1>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="/login" class="flex justify-center items-center text-right">
        @csrf
        <div class="flex-col space-y-2 border-t-2 pt-5 mt-3 border-green-600">
            <!-- Email Address -->
            <div class="grid grid-cols-5">
                <label for="email" class="pr-5 align-middle col-span-2">E-mail</label>
                <input type="email" name="email" id="email" class="col-span-2" required :value="old('email')"/>
            </div>

            <!-- Password -->
            <div class="grid grid-cols-5">
                <label for="password" class="pr-5 align-middle col-span-2">Mot de passe</label>
                <input type="password" name="password" id="password" class="col-span-2" required/>
            </div>

            @error('password')
                <div>{{ $message }}</div>
            @enderror

            <div class="grid grid-cols-5">
                <label for="remember_me" class="pr-5 align-middle col-span-2">Rester connecté</label>
                <input id="remember_me" type="checkbox" name="remember" class="col-span-2">
            </div>

            <div class="text-center">
                <x-form-validation>Se connecter</x-form-validation>
            </div>

            <div class="text-center">
                Pas de compte ? <a href="/register" class="text-green-600 font-bold">Inscrivez-vous !</a>
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
@endsection
