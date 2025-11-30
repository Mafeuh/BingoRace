@extends('layouts.app')

@section('page_title') {{ __('posts.new.page_title') }} @endsection

@section('content')

<div class="flex justify-center">
    <livewire:post-creation-form/>
</div>
@endsection