   <!-- Facts Start -->
   <div class="container-fluid facts my-5 py-5">
    <div class="container py-5">
        <div class="row g-5">
            @for ($i = 1; $i < 5; $i++)
                <div class="col-sm-6 col-lg-3 text-center wow fadeIn" data-wow-delay="{{(0.1)+($i-1)*0.2}}s">
                    <i class="fa {{$curdata['icon'.$i]}} fa-3x text-white mb-3"></i>
                    <h1 class="display-4 text-white" data-toggle="counter-up">{{$curdata['num'.$i]}}</h1>
                    <span class="fs-5 text-white">{{$curdata['title'.$i]}}</span>
                    <hr class="bg-white w-25 mx-auto mb-0">
                </div>

            @endfor

        </div>
    </div>
</div>
<!-- Facts End -->
