@if ($data != null)
    <div class="row pb-5">
        <div class="col-md-3">
            <div class="about-image mb-3">
                <img src="{{ asset($data->image) }}" alt="" class="w-100">
            </div>
        </div>
        <div class="col-md-9">
            <h4 class="text-md-start text-center mb-3">
                {{ $data->title }}
            </h4>
            @if (!empty($data->short_desc))
                <div class="short mb-3 p-3 text-justify">
                    {{ $data->short_desc }}
                </div>
            @endif

            @if (!empty($data->desc->msg_4))
                <div class="mb-3 text-justify">
                    {!! $data->desc->msg_4 !!}
                </div>
            @endif
            <div class="d-flex justify-content-center justify-content-md-end">
                <div class="text-center">

                    <h5 class="mb-0">{{ $data->desc->msg_1 }}</h5>
                    @if (!empty($data->desc->msg_2))
                        <div>{{ $data->desc->msg_2 }}</div>
                    @endif
                    @if (!empty($data->desc->msg_2))
                        <div>{{ $data->desc->msg_3 }}</div>
                    @endif
                    @if (!empty($data->desc->msg_2))
                        <div>{{ $data->desc->msg_5 }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endif

<h1 class="{{ $data != null ? 'mt-5 mb-5' : '' }} text-center text-md-start">
    Know More About Us
</h1>
<div class="row">
    @foreach ($abouts as $about)
        <div class="col-md-4 mb-4">
            <a href="{{ route('page', ['id' => $about->id]) }}">

                <div class="shadow mb-2">
                    <div class="about-image single-about ">
                        <img src="{{ asset($about->image) }}" alt="" class="h-100">
                    </div>
                </div>
                <div class="p-2">
                    <h5>
                        {{ $about->title }}
                    </h5>
                </div>
            </a>
        </div>
    @endforeach
</div>
