@extends('layouts.app')

@section('content')
    <div class="bg-white w-full p-5">
        <h1 class="text-center text-2xl mb-3">
            {{ __('weekly.index.title') }}
        </h1>

        <div class="flex gap-x-3">
            <div class="w-1/3 h-96 bg-slate-200 p-2">
                <h2 class="text-lg text-center">Classements</h2>
            </div>
            <div class="w-2/3 h-96 bg-slate-200 space-y-2 p-2 flex-col">
                <div class="bg-slate-300 h-2/5 p-2">
                    <h2 class="text-lg text-center">Règles</h2>
                </div>
                <div class="bg-slate-300 h-2/5 p-2">
                    <h2 class="text-lg text-center">Cette semaine</h2>
                </div>
            </div>
        </div>
    </div>
@endsection