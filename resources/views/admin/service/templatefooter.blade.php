<h4 class="text-white mb-4">Services</h4>
@foreach ($serviceTypes as $serviceType)
    <a class="btn btn-link" href="{{route('service.types')}}">{{$serviceType->name}}</a>

@endforeach
