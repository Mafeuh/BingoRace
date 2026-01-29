@extends('layouts.app')

@section('content')
<div class="flex h-full">
    <div class="m-auto bg-white/20 dark:bg-white/5 px-6 py-4 backdrop-blur-md rounded border border-white/10">
        <h1 class="text-center text-xl text-blue-300">
            {{ __('register.title') }}
        </h1>
        
        <div class="w-full h-1 bg-gradient-to-r from-red-600 to-blue-600 my-2"></div>

        <form method="POST" action="/register" class="flex justify-center items-center">
            @csrf
            <div class="flex-col space-y-2">

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

                <div class="text-center w-56 dark:text-gray-200">
                    {!! __('register.cgu') !!}
                </div>
                
                <div class="text-center">
                    <x-form.submit-input>
                        {{ __('register.submit') }}
                    </x-form.submit-input>
                </div>
                <div class="text-center dark:text-gray-200">
                    {{ __('register.login.label') }}
                    <a href="/login" class="text-blue-500 font-bold">{{ __('register.login.link') }}</a>
                </div>
            </div>
            
        </form>
    </div>
</div>
@endsection
