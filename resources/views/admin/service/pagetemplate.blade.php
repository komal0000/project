@foreach ($serviceTypes as $serviceType)
<div class="container-xxl py-5">
    <div class="container">
        <div class="wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <h1 class="display-5 mb-5">{{$serviceType->name}}</h1>
        </div>

        <div class="row">

            @foreach ($services->where('service_type_id',$serviceType->id) as $service)
                <div class="col-md-4">
                    <a class="shadow p-3 service" href="{{route('service.single',['service'=>$service->id])}}">

                        <div>
                            <img src="{{asset($service->logo)}}"  alt="" class="img">
                        </div>
                        <h4  class="name mt-3">
                            {{$service->name}}
                        </h4>
                        <p class="desc mb-3">
                            {{$service->short_desc}}
                        </p>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endforeach
