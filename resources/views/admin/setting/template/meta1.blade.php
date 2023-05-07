@php
    $meta = getSetting('meta');
@endphp
@if ($meta != null)
    {{ $meta->title }}
@endif
