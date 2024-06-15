@extends('layouts.app')

@section('content')
<div>
    <div>
        <x-bingo-grid :grid="$room->grid"></x-bingo-grid>
    </div>
</div>
@endsection
