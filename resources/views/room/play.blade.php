@extends('layouts.app')

@section('content')
<div>
    BLABLA

    <pre>{{ json_encode($grid, JSON_PRETTY_PRINT) }}</pre>
    <pre>{{ json_encode($objectives, JSON_PRETTY_PRINT) }}</pre>
</div>
@endsection
