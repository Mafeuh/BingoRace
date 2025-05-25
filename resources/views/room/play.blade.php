@extends('layouts.app')

@section('content')
<div>
    <div class="justify-center flex items-center">
        <x-bingo-grid :grid="$room->grid"></x-bingo-grid>
    </div>
</div>
@endsection
