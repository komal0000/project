  <!-- Features Start -->
  <div class="container-xxl feature py-5">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                <p class="d-inline-block border rounded text-primary fw-semi-bold py-1 px-3">{{$curdata['subtitle']}}</p>
                <h1 class="display-5 mb-4">{{$curdata['title']}}</h1>
                <p class="mb-4">{{$curdata['desc']}}</p>
                <a class="btn btn-primary py-3 px-5" href="{{$curdata['url']}}">Explore More</a>
            </div>
            <div class="col-lg-6">
                <div class="row g-4 align-items-center">
                    <div class="col-md-6">
                        <div class="row g-4">
                            <div class="col-12 wow fadeIn" data-wow-delay="0.3s">
                                <div class="feature-box border rounded p-4">
                                    <i class="fa fa-check fa-3x text-primary mb-3"></i>
                                    <h4 class="mb-3">{{$curdata['title1']}}</h4>
                                    <p class="mb-3">{{$curdata['desc1']}}</p>
                                    <a class="fw-semi-bold" href="{{$curdata['url1']}}">Read More <i
                                            class="fa fa-arrow-right ms-1"></i></a>
                                </div>
                            </div>
                            <div class="col-12 wow fadeIn" data-wow-delay="0.5s">
                                <div class="feature-box border rounded p-4">
                                    <i class="fa fa-check fa-3x text-primary mb-3"></i>
                                    <h4 class="mb-3">{{$curdata['title2']}}</h4>
                                    <p class="mb-3">{{$curdata['desc2']}}</p>
                                    <a class="fw-semi-bold" href="{{$curdata['url2']}}">Read More <i
                                            class="fa fa-arrow-right ms-1"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 wow fadeIn" data-wow-delay="0.7s">
                        <div class="feature-box border rounded p-4">
                            <i class="fa fa-check fa-3x text-primary mb-3"></i>
                            <h4 class="mb-3">{{$curdata['title3']}}</h4>
                            <p class="mb-3">{{$curdata['desc3']}}</p>
                            <a class="fw-semi-bold" href="{{$curdata['url3']}}">Read More <i class="fa fa-arrow-right ms-1"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Features End -->
