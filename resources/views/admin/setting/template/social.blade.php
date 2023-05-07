@foreach ($curdata as $key=>$item)
    @if ($item!="#")     
        <a href="{{$item}}" class="social-link">
            <i class="fab {{\App\Data::iconmap[$key]}}"></i>
        </a>
    @endif
@endforeach