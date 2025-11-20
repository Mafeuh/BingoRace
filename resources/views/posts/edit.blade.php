@extends('layouts.app')

@section('content')
{{-- TODO: Changer le style de merde de cette page --}}
<div>
    <h1 class="text-center mb-8 text-emerald-800">
        {{ __('posts.edit.page_title') }}
    </h1>
</div>

<div class="flex justify-center">
    <livewire:post-creation-form :post="$post"/>
</div>
@endsection