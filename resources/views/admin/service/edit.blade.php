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
    <li class="breadcrumb-item">
        <a href="{{ route('admin.team.type.index') }}">Services</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('admin.service.index', ['type' => $service->type->id]) }}">{{ $service->type->name }}</a>
    </li>
    <li class="breadcrumb-item ">
        {{ $service->name }}
    </li>
    <li class="breadcrumb-item active">
        edit
    </li>
@endsection
@section('content')
    <div class="card shadow mb-3">
        <div class="card-body">
            <form action="{{ route('admin.service.edit', ['service' => $service->id]) }}" method="post"
                enctype="multipart/form-data" id="edit-service">

                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <input type="file" name="logo" id="logo" class="photo" accept="image/*"
                            data-default-file="{{ asset($service->logo) }}">
                    </div>
                    <div class="col-9">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" required class="form-control" required
                                value="{{ $service->name }}">
                        </div>
                        <div class="form-group">
                            <label for="short_desc">Short Description</label>
                            <textarea name="short_desc" id="short_desc" rows="4" class="form-control" required>{{ $service->short_desc }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="desc">Description</label>
                            <textarea name="desc" id="desc" rows="4" class="form-control desc">{!! $service->desc !!}</textarea>
                        </div>

                        <div class="text-right">
                            <button class="btn btn-primary mr-2">Save Service</button>
                            <a href="{{ route('admin.service.index', ['type' => $service->type->id]) }}"
                                class="btn btn-danger">Cancel</a>
                        </div>
                    </div>




                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://cdn.tiny.cloud/1/4adq2v7ufdcmebl96o9o9ga7ytomlez18tqixm9cbo46i9dn/tinymce/5/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script src="{{ asset('admin/plugins/drophify/js/dropify.min.js') }}"></script>
    <script>
        var state = false;



        @include('admin.layout.includes.tinysupport')
        $(function() {
            $('.photo').dropify();
            @include('admin.layout.includes.tiny')
            $('#edit-service').submit(function(e) {
                e.preventDefault();
                axios.post(this.action, new FormData(this))
                    .then((res) => {
                        toastr.success('Service Saved Sucessfully');

                    })
                    .catch((err) => {
                        toastr.error('Service Not Saved, Some Error Occured');
                    });
            });
        });
    </script>
@endsection
