@props(['grid', 'editable', 'team'])

<div class="grid grid-cols-{{$grid->width}} w-fit gap-1 static">
    @foreach ($grid->squares as $square)
        <livewire:bingo-grid-square :square="$square" :team="$team" :editable="$editable"/>
    @endforeach
</div>