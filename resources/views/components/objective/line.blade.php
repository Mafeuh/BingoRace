@props([
    'objective',
    'can_manage_objectives' => false
])



@admin()
    <input class="hidden" type="checkbox" id="obj{{ $objective->id }}" wire:model="selected_objectives.{{ $objective->id }}">
@endadmin
<label
    @admin()
    for="obj{{ $objective->id }}"
    x-on:click="
        selected.includes({{ $objective->id }})
            ? selected = selected.filter(id => id !== {{ $objective->id }})
            : selected.push({{ $objective->id }});
        "
    @endadmin
:class="selected.includes({{ $objective->id }}) ? 'bg-blue-300 dark:bg-blue-900' : 'mx-2 dark:bg-slate-900/50 bg-gray-100/50'"
class="relative dark:text-gray-200 p-1 text-center rounded-xl cursor-pointer transition-all duration-100 select-none max-w-full overflow-hidden">
    <div class="flex space-x-2">
        <span class="grow">
            {{$objective->description}}
        </span>
        <span @class([ "font-bold",
            "text-blue-500" => $objective->difficulty == 1,
            "text-green-500" => $objective->difficulty == 2,
            "text-orange-400" => $objective->difficulty == 3,
            "text-red-500" => $objective->difficulty == 4
        ])>{{ $objective->difficulty }}</span>
        @if($can_manage_objectives)
        <a class="right-5" href="/objectives/{{$objective->id}}/edit">✏️</a>
        @endif
    </div>
</label>