@props(['grid', 'editable'])

<div class="grid grid-cols-{{$grid->width}} w-fit">
    @foreach ($grid->squares as $square)
        <livewire:bingo-grid-square :square="$square" :editable="$editable"></bingo-grid-square>
    @endforeach
</div>