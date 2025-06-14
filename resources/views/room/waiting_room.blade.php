@extends('layouts.app')

@section('content')
<div class="h-fit">
    <div class="grid lg:grid-cols-3 h-fit gap-5">
        <div class="bg-white p-3 shadow-inner shadow-green-100 rounded-3xl h-fit">
            <livewire:participants-list :room="$room" />
        </div>
        <div class="lg:col-span-2 2xl:col-span-1">
            <div>
                <h1 class="text-3xl text-center">La partie est sur le point de commencer !</h1>
                <h2 class="text-2xl text-center">Code de la salle :
                    <span x-data="{ show: false }" x-on:click="show = !show">
                        <span x-show="!show" class="bg-gray-700 text-white rounded-md">Révéler&nbsp;!</span>
                        <span x-show="show" class="font-bold">{{ $room->code }}</span>
                    </span>
                    <button class="bg-white shadow-xl rounded-full py-2 px-4" onclick="copyText()" id="copy_button">Copier&nbsp;?</button>
                    <script>
                        function copyText() {
                            const texte = "{{ $room->code }}";
                            navigator.clipboard.writeText(texte)
                                .then(() => document.getElementById('copy_button').innerText = "Copié !");
                        }
                    </script>
                </h2>
            </div>

            <div class="bg-green-100 m-5 p-5 rounded-xl">
                <div class="font-bold text-green-500">Rappel des règles:</div>
                <div>
                    Une grille de  {{ $room->grid->height * $room->grid->width }} cases va apparaître. Chacune de ces cases va contenir un objectif à remplir.
                </div>
                <div>
                    Pour gagner, faites en sorte que votre équipe coche plus de case que les autres équipes. Pour cocher une case, il faut évidemment remplir l'objectif :).
                </div>
            </div>

            <div class="justify-center flex text-center my-4">
                <livewire:room-timer-setter :room="$room" :disabled="auth()->user()->id !== $room->creator_id"/>
            </div>

            @if (auth()->user()->id == $room->creator_id)
                <div class="mt-10 text-center text-xl">
                    Une fois tous les participants présents, clique sur <span class="font-bold">Commencer</span> !
                </div>

                <form action="{{ route('room-start') }}" method="POST" class="text-center">
                    @csrf
                    <button class="text-xl bg-green-500 px-5 py-3 rounded-full font-bold hover:bg-green-700 active:animate-ping" type="submit">Commencer !</button>
                </form>
            @else
                <livewire:redirect-to-room :room="$room" />
            @endif
        </div>

    </div>
</div>
@endsection
