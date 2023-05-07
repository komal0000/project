@extends('admin.layout.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('admin/plugins/drophify/css/dropify.min.css') }}">
    <style>
        .col-md-3 {
            margin-bottom: 10px;
        }

        label {
            font-weight: 600;
            font-size: 1.1rem;
            /* margin-bottom: 5px; */
            color: black;
            margin-top: 5px;
        }

        .form-control,
        .tox {
            border-radius: 5px !important;
        }

    </style>
@endsection
@section('page-option')
@endsection
@section('s-title')
    <li class="breadcrumb-item active">
        Galleries
    </li>
@endsection
@section('content')

    <div class="bg-white shadow mb-3">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <form class="p-2 shadow" action="{{route('admin.setting.gallery.type.add')}}" enctype="multipart/form-data" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="icon">icon</label>
                            <input type="file" name="icon" id="icon" class="form-control photo" required>
                        </div>
                        <div class="py-2">
                            <button class="btn btn-primary">Add Gallery</button>
                        </div>
                    </form>
                </div>
                @foreach ($types as $type)
                    <div class="col-md-4">
                        <form class="shadow p-2" action="{{route('admin.setting.gallery.type.edit',['type'>$type->id])}}" enctype="multipart/form-data" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" value="{{$type->name}}" name="name" id="name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="icon">icon</label>
                                <input type="file" name="icon" id="icon" class="form-control photo" data-default-file="{{asset($type->icon)}}">
                            </div>
                            <div class="div py-2 d-flex justify-content-between">
                                <button class="btn btn-secondary">Update</button>
                                <a  href="{{route('admin.setting.gallery.index',['type'=>$type->id])}}"   class="btn btn-success">Manage</a>
                                <a onclick="return prompt('Enter yes To Continue.')=='yes';" href="{{route('admin.setting.gallery.type.del',['type'=>$type->id])}}" class="btn btn-danger">Del</a>
                            </div>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('admin/plugins/drophify/js/dropify.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('.photo').dropify();
        });
    </script>
@endsection
