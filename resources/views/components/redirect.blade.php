@props(['check', 'url'])

@if ($check)
    <script>
        window.location.href = "{{ $url }}";
    </script>    
@endif