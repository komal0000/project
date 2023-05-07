<div class="site-section section-counter">
    <div class="container">
        <div class="row">
            <div class="col-md-6 pr-5">
                <div class="block-48">
                    <span class="block-48-text-1">{{ $intro->Title }}</span>
                    <div class="block-48-counter ftco-number" data-number="{{ $intro->data->number }}">0</div>
                    <span class="block-48-text-1 mb-4 d-block">{{ $intro->short_desc }}</span>
                </div>
            </div>
            <div class="col-md-6 welcome-text">
                <h2 class="display-4 mb-3">{{ $intro->data->title1 }}</h2>
                <p class="lead">{{ $intro->data->desc1 }}</p>
                <p class="mb-4">{{ $intro->data->sdesc1 }}</p>
            </div>
        </div>
    </div>
</div>
