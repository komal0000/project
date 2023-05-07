 <!-- Carousel Start -->
 @if ($sliders->count()>0)
<div class="block-31" style="position: relative;">
    <div class="owl-carousel loop-block-31 ">
        @foreach ($sliders as $key=>$slider)
        <div class="block-30 block-30-sm item" style="background-image: url('{{asset($slider->image)}}');"
            data-stellar-background-ratio="0.5">
            <div class="container">
                <div class="row align-items-center justify-content-center text-center">
                    <div class="col-md-7">
                        <h2 class="heading mb-5">  {!! $slider->title!!}</h2>
                        <p style="display: inline-block;">
                            {!! $slider->subtitle !!}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
 @endif
<!-- Carousel End -->


