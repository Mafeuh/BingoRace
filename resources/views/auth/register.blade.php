@extends('layouts.app')

@section('content')
<div class="bg-green-100 mx-20 p-10 rounded-3xl shadow-lg shadow-green-300">
    <h1 class="text-3xl font-bold text-center">{{ __('Register') }}</h1>

    <form method="POST" action="/" class="flex justify-center items-center text-right">
        @csrf
        <div class="flex-col space-y-2 border-t-2 pt-5 mt-3 border-green-600">

            <!-- Name -->
            <div class="grid grid-cols-5">
                <label for="name" class="pr-5 align-middle col-span-2">{{ __('Name') }}</label>
                <input type="text" name="name" id="name" class="col-span-2" required :value="old('name')"/>
            </div>
            @error('name')
                <div class="text-red-200">{{$message}}</div>
            @enderror

            <!-- Email Address -->
            <div class="grid grid-cols-5">
                <label for="email" class="pr-5 align-middle col-span-2">E-mail</label>
                <input type="email" name="email" id="email" class="col-span-2" required :value="old('email')"/>
            </div>
            @error('email')
                <div class="text-red-200">{{$message}}</div>
            @enderror

            <!-- Password -->
            <div class="grid grid-cols-5">
                <label for="password" class="pr-5 align-middle col-span-2">{{ __('Password') }}</label>
                <input type="password" name="password" id="password" class="col-span-2" required>
            </div>
            @error('password')
                <div class="text-red-200">{{$message}}</div>
            @enderror

            <!-- Confirm Password -->
            <div class="grid grid-cols-5">
                <label for="password_confirmation" class="pr-5 align-middle col-span-2">{{ __('Confirm Password') }}</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="col-span-2" required>
            </div>
            @error('password_confirmation')
                <div class="text-red-200">{{$message}}</div>
            @enderror

            <div class="text-center">
                <x-form-validation>S'inscrire !</x-form-validation>
            </div>
        </div>

    </form>
</div>
@endsection
