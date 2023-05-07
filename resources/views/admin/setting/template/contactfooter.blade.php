@php
    $data =
        getSetting('contact') ??
        ((object) [
            'map' => '',
            'email' => '',
            'phone' => '',
            'addr' => '',
            'others' => [],
        ]);
@endphp

<div class="d-flex border-botton pb-3 mb-3">
    <div class="flex-shrink-0 btn-square bg-primary text-white rounded-circle">
        <i class="icon icon-map-marker-alt"></i>
    </div>
    <div class="ms-3">
        <h6>
            Our Office
        </h6>
        <span> {{ $data->addr }} </span>
    </div>
</div>
<div class="d-flex border-botton pb-3 mb-3">
    <div class="flex-shrink-0 btn-square bg-primary text-white rounded-circle">
        <i class="icon icon-map-marker-alt"></i>
    </div>
    <div class="ms-3">
        <h6>
            Call Us
        </h6>
        <span> {{ $data->phone }} </span>
    </div>
</div>
<div class="d-flex border-botton pb-3 mb-3">
    <div class="flex-shrink-0 btn-square bg-primary text-white rounded-circle">
        <i class="icon icon-map-marker-alt"></i>
    </div>
    <div class="ms-3">
        <h6>
            Mail Us
        </h6>
        <span> {{ $data->email }} </span>
    </div>
</div>
