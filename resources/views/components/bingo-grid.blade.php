@props(['grid'])

<div class="bg-white grid grid-cols-{{$grid->width}} w-fit">
    @foreach ($grid->squares as $square)
        <livewire:bingo-grid-square :square="$square"></bingo-grid-square>
    @endforeach
</div>