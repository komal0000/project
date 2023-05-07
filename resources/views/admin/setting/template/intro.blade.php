<div class="site-section section-counter">
    <div class="container">
        <div class="row">
            <div class="col-md-6 pr-5">
                <div class="block-48">
                    <span class="block-48-text-1">{{ $curdata['Title'] }}</span>
                    <div class="block-48-counter ftco-number" data-number="{{ $curdata['Number'] }}">0</div>
                    <span class="block-48-text-1 mb-4 d-block">{{ $curdata['Sdesc'] }}</span>
                </div>
            </div>
            <div class="col-md-6 welcome-text">
                <h2 class="display-4 mb-3">{{ $curdata['Title1'] }}</h2>
                <p class="lead">{{ $curdata['Desc1'] }}</p>
                <p class="mb-4">{{ $curdata['Sdesc1'] }}</p>
            </div>
        </div>
    </div>
</div>
