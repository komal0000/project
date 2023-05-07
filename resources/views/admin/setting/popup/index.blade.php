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
    <a class="btn btn-primary" href="{{ route('admin.setting.popup.add') }}">
        Add New Popup
    </a>
@endsection
@section('s-title')
    <li class="breadcrumb-item">
        Popups
    </li>

@endsection
@section('content')

    <div class="card shadow">
        <div class="card-body">
            @foreach ($popups as $popup)
                <div class="shadow mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-9">
                                <h4>
                                    Desktop Image
                                </h4>
                                <div style="max-height: 200px;overflow-y:auto">

                                    <img src="{{ asset($popup->image) }}" alt="" class="w-100">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <h4>Mobile Image</h4>
                                <div style="max-height: 200px;overflow-y:auto">
                                    <img src="{{ asset($popup->mobile_image) }}" alt="" class="w-100">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="py-2">
                            <a href="{{route('admin.setting.popup.edit',['popup'=>$popup->id])}}" class="btn btn-success">Edit</a>
                            @if ($popup->active==1)
                            <a href="{{route('admin.setting.popup.status',['popup'=>$popup->id,'status'=>0])}}" class="btn btn-warning">Deactivate</a>
                            @else
                            <a href="{{route('admin.setting.popup.status',['popup'=>$popup->id,'status'=>1])}}" class="btn btn-success">Activate</a>

                            @endif
                            <a href="{{route('admin.setting.popup.del',['popup'=>$popup->id])}}" class="btn btn-danger">Delete</a>
                        </div>
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
