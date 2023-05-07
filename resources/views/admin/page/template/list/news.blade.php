<div class="site-section bg-light">
    <div class="container">
        <div class="row">
            @foreach ($news as $n)
                <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-4 mb-lg-0">
                    <div class="post-entry">
                        <a href="{{ route('news', ['id' => $n->id]) }}" class="mb-3 img-wrap">
                            <img src="{{ $n->image }}" alt="Image placeholder" class="img-fluid">
                        </a>
                        <h3><a href="#">{{ $n->title }}</a></h3>
                        <p>{{ $n->short_desc }}</p>
                        <p><a href="{{ route('news', ['id' => $n->id]) }}" class="link-underline">Read More</a></p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
