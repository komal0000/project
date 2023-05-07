<div class="col-md-6 col-lg-4">
    <h3 class="heading-section">Recent story</h3>
    @foreach ($news->take(3) as $n)
        <div class="block-21 d-flex mb-4">
            <figure class="mr-3">
                <img src="{{ asset($n->image) }}" alt="" class="img-fluid">
            </figure>
            <div class="text">
                <h3 class="heading"><a href="#">{{ $n->title }}</a></h3>
                <div class="meta">
                    @php
                        $date = DateTime::createFromFormat("Y-m-d H:i:s", $n->created_at);
                    @endphp
                    <div><a href="#"><span class="icon-calendar"></span> {{$date->format("F d, Y")}}</a></div>

                </div>
            </div>
        </div>
    @endforeach
</div>
