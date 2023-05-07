<style>
    .top-bar{
        background: white;
    }

</style>
{{-- @php
    dd("sdaf");
@endphp --}}
<div class="top-bar row gx-0 align-items-center d-none d-lg-flex" >
    <div class="col-lg-6 px-5 text-start">
        <small><i class="fa fa-map-marker-alt text-primary me-2"></i>{{$curdata['address']}}</small>
        <small class="ms-4"><i class="fa fa-clock text-primary me-2"></i>{{$curdata['opening']}}</small>
    </div>
    <div class="col-lg-6 px-5 text-end">
        <small><i class="fa fa-envelope text-primary me-2"></i>{{$curdata['email']}}</small>
        <small class="ms-4"><i class="fa fa-phone-alt text-primary me-2"></i>{{$curdata['phone']}}</small>
    </div>
</div>


