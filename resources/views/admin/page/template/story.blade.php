<div class="featured-section overlay-color-2" style="background-color: rebeccapurple">
    <div class="container">
        <div class="row">

            <div class="col-md-6">
                <img src="{{ asset($story->image) }}" alt="Image placeholder" class="img-fluid">
            </div>

            <div class="col-md-6 pl-md-5">
                <span class="featured-text d-block mb-3">
                    {{ $story->title }}
                </span>
                <h2>
                    {{ $story->data->stitle }}
                </h2>
                <p class="mb-3">
                    {{ $story->data->sdesc }}
                </p>
                <p>
                    <a href="{{route('story',['id'=>$story->id])}}"
                        class="btn btn-success btn-hover-white py-3 px-5">
                        Read The FullStory
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>
