@php
    $meta=getSetting('meta');
@endphp
@if ($meta!=null)
    <meta name="description" content="{{$meta->desc}}">
    <meta name="keywords" content="{{$meta->keyword}}">
    <meta name="author" content="John Doe">
    <meta property="og:url"                content="{{url('')}}" />
    <meta property="og:type"               content="article" />
    <meta property="og:title"              content="{{ env('APP_NAME') }} @yield('title')" />
    <meta property="og:description"        content="{{$meta->desc}}" />
    <meta property="og:image"              content="{{asset($meta->image)}}" />
@endif