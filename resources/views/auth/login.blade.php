@extends('layouts.app')

@section('content')

<div class="flex h-full">
    <div class="m-auto bg-white/20 dark:bg-white/5 px-6 py-4 backdrop-blur-md rounded border border-white/10">
        <h1 class="text-center text-xl text-blue-300">
            {{ __('login.title') }}
        </h1>

        <div class="h-px bg-gradient-to-r from-blue-500 to-red-500 my-2"></div>

        <x-auth-session-status class="mb-4" :status="session('status')" />
        
        <form method="POST" action="/login" class="flex justify-center items-center">
            @csrf
            <div class="flex-col space-y-2">
                <!-- Email Address -->
                <div class="flex flex-col">
                    <x-form.label for="email">
                        {{ __('login.email.label') }}
                    </x-form.label>
                    <x-form.email-input name="email" required :value="old('email')" placeholder="{{ __('login.email.placeholder') }}"/>
    
                    <x-form.error name="email"/>
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
                    <label for="remember_me" class="pr-5 align-middle col-span-2 dark:text-gray-200">
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
                    <span class="dark:text-gray-200">
                        {{ __('login.register.label') }}
                    </span>
                    <a href="/register" class="text-blue-500 font-bold">{{ __('login.register.link') }}</a>
                </div>
            </div>
        </form>
    </div>
</div>


{{-- <div class="items-center justify-center">
    <div class="mx-auto p-10 rounded-2xl w-80
        bg-white shadow-white
        dark:bg-slate-700 dark:shadow-blue-500">

        <x-auth-session-status class="mb-4" :status="session('status')" />

        <div class="w-full h-1 bg-gradient-to-r from-red-600 to-blue-600 my-2"></div>
    
        <form method="POST" action="/login" class="flex justify-center items-center">
            @csrf
            <div class="flex-col space-y-2">
                <!-- Email Address -->
                <div class="flex flex-col">
                    <x-form.label for="email">
                        {{ __('login.email.label') }}
                    </x-form.label>
                    <x-form.email-input name="email" required :value="old('email')" placeholder="{{ __('login.email.placeholder') }}"/>
    
                    <x-form.error name="email"/>
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
                    <label for="remember_me" class="pr-5 align-middle col-span-2 dark:text-gray-200">
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
                    <span class="dark:text-gray-200">
                        {{ __('login.register.label') }}
                    </span>
                    <a href="/register" class="text-blue-500 font-bold">{{ __('login.register.link') }}</a>
                </div>
            </div>
        </form>
    </div>
</div> --}}
@endsection
