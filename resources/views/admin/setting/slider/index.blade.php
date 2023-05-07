@extends('admin.layout.app')
@section('css')
    <style>
        .btn-preview {
            background: #ffb606;
            border-radius: 5px;
            color: #fff !important;
            display: inline-block;
            font-size: 16px;
            font-weight: 700;
            line-height: 1;
            padding: 16px 29px;
            position: relative;
            text-transform: uppercase;
            text-decoration: none;
            -webkit-transform: perspective(1px) translateZ(0);
            transform: perspective(1px) translateZ(0);
            -webkit-transition: color .3s ease 0s;
            transition: color .3s ease 0s;
            vertical-align: middle;
        }

    </style>
@endsection
@section('page-option')
    <a class="btn btn-primary" href="{{ route('admin.setting.slider.add') }}">
        Add New Slider
    </a>
@endsection
@section('s-title')
    <li class="breadcrumb-item">
        Sliders
    </li>

@endsection
@section('content')

    <div class="card shadow">
        <div class="card-body">
            @foreach ($sliders as $slider)
                <div class="shadow mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <h4>
                                    Desktop Image
                                </h4>
                                <div style="max-height: 200px;overflow-y:auto">

                                    <img src="{{ asset($slider->image) }}" alt="" class="w-100">
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="">
                                    <h4>Title</h4>
                                    {{ $slider->title }}
                                </div>
                                <hr>
                                <div class="">
                                    <h4>SubTitle</h4>
                                    {{ $slider->subtitle }}
                                </div>
                                <hr>
                                <div class="py-2">
                                    <a href="{{route('admin.setting.slider.edit',['slider'=>$slider->id])}}" class="btn btn-success">Edit</a>
                                    <a href="{{route('admin.setting.slider.del',['slider'=>$slider->id])}}" class="btn btn-danger">Delete</a>
                                </div>
                            </div>
                            {{-- <div class="col-md-3">
                                <h4>Mobile Image</h4>
                                <div style="max-height: 200px;overflow-y:auto">
                                    <img src="{{ asset($slider->mobile_image) }}" alt="" class="w-100">
                                </div>
                            </div> --}}
                        </div>

                        {{-- <div class="">
                            <h4>Link Button</h4>
                            <div class="row">
                                <div class="col-md-3">
                                    <strong>Text</strong> <br>
                                    <span>{{ $slider->link_title }}</span>
                                </div>
                                <div class="col-md-4">
                                    <strong>Link</strong> <br>
                                    <span>{{ $slider->link }}</span>
                                </div>
                                <div class="col-md-5">
                                    <strong>Preview : </strong>
                                    <a href="{{$slider->link}}" class="btn-preview">{{$slider->link_title}}</a>
                                </div>
                            </div>
                        </div>
                        <hr> --}}

                    </div>
                </div>
            @endforeach
        </div>
    </div>


@endsection
@section('script')
    <script>

    </script>
@endsection
