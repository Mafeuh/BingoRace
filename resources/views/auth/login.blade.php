@extends('layouts.app')

@section('content')
<div class="h-full flex items-center justify-center">
    <div class="bg-white p-10 rounded-3xl shadow-lg shadow-white">
        <h1 class="text-3xl font-bold text-center">
            {{ __('login.title') }}
        </h1>
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />
    
        <form method="POST" action="/login" class="flex justify-center items-center">
            @csrf
            <div class="flex-col space-y-2 border-t-2 pt-5 mt-3 border-green-600">
                <!-- Email Address -->
                <div class="flex flex-col">
                    <x-form.label for="email">
                        {{ __('login.email.label') }}
                    </x-form.label>
                    <x-form.email-input name="email" required :value="old('email')" placeholder="{{ __('login.email.placeholder') }}"/>
    
                    @error('email')
                        <div>{{ $message }}</div>
                    @enderror
                </div>
    
                <!-- Password -->
                <div class="flex flex-col">
                    <x-form.label for="password">
                        {{ __('login.password.label') }}
                    </x-form.label>
                    <x-form.password-input name="password" required :value="old('password')" placeholder="{{ __('login.password.placeholder') }}"/>
    
                    @error('password')
                        <div>{{ $message }}</div>
                    @enderror
                </div>
    
    
                <div class="text-center">
                    <label for="remember_me" class="pr-5 align-middle col-span-2">
                        {{ __('login.stay_connected') }}
                    </label>
                    <x-form.checkbox-input name="remember_me"/>
                </div>
    
                <div class="text-center">
                    <x-form.submit-input>
                        {{ __('login.button') }}
                    </x-form.submit-input>
                </div>
    
                <div class="text-center">
                    {{ __('login.register.label') }} <a href="/register" class="text-green-600 font-bold">{{ __('login.register.link') }}</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
