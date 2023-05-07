<div class="site-section bg-light">
    <div class="container">
        <div class="row">
            @foreach ($stories as $story)
                <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-4 mb-lg-0">
                    <div class="post-entry">
                        <a href="{{ route('story', ['id' => $story->id]) }}" class="mb-3 img-wrap">
                            <img src="{{ $story->image }}" alt="Image placeholder" class="img-fluid">
                        </a>
                        <h3><a href="#">{{ $story->title }}</a></h3>
                        <p>{{ $story->short_desc }}</p>
                        <p><a href="{{ route('story', ['id' => $story->id]) }}" class="link-underline">Read More</a></p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
