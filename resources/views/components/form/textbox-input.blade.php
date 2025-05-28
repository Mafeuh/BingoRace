@props([
    'placeholder' => '',
    'value' => '',
    'name',
    'required' => null
])

<textarea 
    type="text" 
    value="{{$value}}" 
    name="{{$name}}" 
    id="{{$name}}"
    @required($required != null)
    class="border-1 border-gray-200 rounded-xl py-3"
></textarea>
<script>
    document.getElementById("{{ $name }}").placeholder = "{{ $placeholder }}";
</script>

