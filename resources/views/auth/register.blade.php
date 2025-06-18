@extends('layouts.app')

@section('content')
<div class="h-full flex items-center justify-center">

    <div class="bg-white mx-20 px-20 py-10 rounded-3xl shadow-lg shadow-white">
        <h1 class="text-3xl font-bold text-center">
            {{ __('register.title') }}
        </h1>
        
        <form method="POST" action="/register" class="flex justify-center items-center">
            @csrf
            <div class="flex-col space-y-2 border-t-2 pt-5 mt-3 border-green-600">

                <!-- Name -->
                <div class="flex flex-col">
                    <x-form.label for="name">
                        {{ __('register.name.label') }}
                    </x-form.label>
                    <x-form.text-input name="name" required="" :value="old('name')" placeholder="{{ __('register.name.placeholder') }}"/>
                    <x-form.error name="name"/>
                </div>
                
                <!-- Email Address -->
                <div class="flex flex-col">
                    <x-form.label for="email">
                        {{ __('register.email.label') }}
                    </x-form.label>
                    <x-form.email-input name="email" required="" :value="old('email')" placeholder="{{ __('register.email.placeholder') }}"/>
                    <x-form.error name="email"/>
                </div>
                
                <!-- Password -->
                <div class="flex flex-col">
                    <x-form.label for="password">
                        {{ __('register.password.label') }}
                    </x-form.label>
                    <x-form.password-input name="password" required="" placeholder="{{ __('register.password.placeholder') }}"/>
                    <x-form.error name="password"/>
                </div>
                
                <!-- Confirm Password -->
                <div class="flex flex-col">
                    <x-form.label for="password_confirmation">
                        {{ __('register.password.confirm.label') }}
                    </x-form.label>
                    <x-form.password-input name="password_confirmation" required="" placeholder="{{ __('register.password.confirm.placeholder') }}"/>
                    <x-form.error name="password_confirmation"/>
                </div>
                
                <div class="text-center">
                    <x-form-validation>
                        {{ __('register.submit') }}
                    </x-form-validation>
                </div>
                <div class="text-center">
                    {{ __('register.login.label') }}
                    <a href="/login" class="text-green-600 font-bold">{{ __('register.login.link') }}</a>
                </div>
            </div>
            
        </form>
    </div>
</div>
@endsection
