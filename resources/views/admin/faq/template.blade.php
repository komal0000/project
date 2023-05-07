<div class="container-fluid my-5">
    <div class="row">
        @foreach ($faqs as $faq)

            <div class="col-md-12 mb-3">
                <div class="singlefaq p-2" >
                    <h5>{{$faq->q}}</h5>
                    <p>
                        {!! $faq->a !!}
                    </p>
                </div>
            </div>
        @endforeach
    </div>
</div>
