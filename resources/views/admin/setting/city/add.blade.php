@extends('admin.layout.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('admin/plugins/drophify/css/dropify.min.css') }}">
@endsection

@section('s-title')
    <li class="breadcrumb-item">Setting</li>
    <li class="breadcrumb-item"><a href="{{route('admin.setting.city.index')}}">Cities</a></li>
    <li class="breadcrumb-item">Add</li>

@endsection
@section('content')
    <div class="card shadow">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <input type="file" name="image" id="image" class="dropify" accept="image/*">
                </div>
                <div class="col-md-3">

                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('admin/plugins/drophify/js/dropify.min.js') }}"></script>
    <script>
        var state = 1;
        $(document).ready(function() {
            $('.dropify').dropify();
        });


    </script>
@endsection
