@extends('layouts.app')

@section('content')

<div>
    <h1 class="text-center text-4xl mb-8 text-emerald-800">
        {{ __('posts.new.page_title') }}
    </h1>
</div>

<div class="flex justify-center">
    <livewire:post-creation-form/>
</div>
@endsection