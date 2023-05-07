@extends('admin.layout.app')
@section('css')
    <style>
        .col-md-3 {
            /* margin-bottom: 10px; */
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
        <link rel="stylesheet" href="{{ asset('admin/plugins/drophify/css/dropify.min.css') }}">
@endsection
@section('page-option')

@endsection
@section('s-title')
    <li class="breadcrumb-item ">
        <a href="{{route('admin.service.type.index')}}">
            Service Types
        </a>
    </li>
    <li class="breadcrumb-item active">
        Add
    </li>

@endsection
@section('content')

    <div class="bg-white mb-3 shadow p-3">
        <form  action="{{route('admin.service.type.add')}}" enctype="multipart/form-data" method="post">
            @csrf
            <div class="row">
                <div class="col-md-3 pt-2">
                    <label for="home_image">Home Image</label>
                    <input type="file" name="home_image" id="home_image" class="photo">
                </div>
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="desc">Short Description</label>
                                <input type="text" name="desc" id="desc" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="home_tiles">Home Tiles</label>
                                <input type="text" name="home_tiles" id="home_tiles" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="home_title">Home Title</label>
                                <input type="text" name="home_title" id="home_title" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="home_desc">Home Description</label>
                                <input type="text" name="home_desc" id="home_desc" class="form-control" required>
                            </div>
                        </div>



                        <div class="col-md-2">
                                <button class="btn btn-primary">Save Data</button>
                        </div>
                    </div>
                </div>

            </div>

        </form>
    </div>

@endsection
@section('script')

    <script src="{{ asset('admin/plugins/drophify/js/dropify.min.js') }}"></script>
    <script>

        $(function() {
            $('.photo').dropify();

        });
    </script>
@endsection
