<div class="site-section">
    <div class="container">
        <div class="row">
            @foreach ($galleries as $gallery)
                <div class="col-md-4">
                    <a href="{{ asset($gallery->file) }}" class="img-hover" data-fancybox="gallery">
                        <span class="icon icon-search"></span>
                        <img src="{{ asset($gallery->file) }}" alt="Image placeholder" class="img-fluid">
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
