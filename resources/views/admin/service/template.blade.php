<!-- Service Start -->
<div class="container-xxl service py-5">
    <div class="container">
        <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <p class="d-inline-block border rounded text-primary fw-semi-bold py-1 px-3">Our Services</p>
            <h1 class="display-5 mb-5">Awesome Financial Services For Business</h1>
        </div>
        <div class="row g-4 wow fadeInUp" data-wow-delay="0.3s">
            <div class="col-lg-4">
                <div class="nav nav-pills w-100 me-4">
                    @foreach ($serviceTypes as $key=>$serviceType)

                        <button class="nav-link w-100 d-flex align-items-center text-start border p-4 mb-4 {{$key==0?"active":""}}"
                            data-bs-toggle="pill" data-bs-target="#tab-pane-{{$serviceType->id}}" type="button" >
                            <h5 class="m-0"><i class="fa fa-bars text-primary me-3"></i>{{$serviceType->name}}</h5>
                        </button>
                    @endforeach


                </div>
            </div>
            <div class="col-lg-8">
                <div class="tab-content w-100">
                    @foreach ($serviceTypes as $key=>$serviceType)

                        <div class="tab-pane fade show {{$key==0?"active":""}}" id="tab-pane-{{$serviceType->id}}">
                            <div class="row g-4">
                                <div class="col-md-6" style="min-height: 350px;">
                                    <div class="position-relative h-100">
                                        <img class="position-absolute rounded w-100 h-100" src="{{asset($serviceType->home_image)}}"
                                            style="object-fit: cover;" alt="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h3 class="mb-4">{{$serviceType->home_title}}</h3>
                                    <p class="mb-4">{{$serviceType->home_desc}}</p>

                                    @foreach ($services->where('service_type_id',$serviceType->id) as $service)
                                        <p>
                                            <i class="fa fa-check text-primary me-3"></i>
                                            <a href="{{route('service.single',['service'=>$service->id])}}">{{$service->name}}</a>
                                        </p>

                                    @endforeach


                                    <a href="{{route('service.types')}}" class="btn btn-primary py-3 px-5 mt-3">Read More</a>
                                </div>
                            </div>
                        </div>
                    @endforeach


                </div>
            </div>
        </div>
    </div>
</div>
<!-- Service End -->
