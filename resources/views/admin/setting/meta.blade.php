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
            text-transform: capitalize;
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
        Meta
    </li>
@endsection
@section('content')
    <div class="card shadow mb-3">
        <div class="card-body">
            <form action="{{ route('admin.setting.meta') }}" method="post" enctype="multipart/form-data">

                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <label for="keyword">Keyword</label>
                        <input type="text" name="keyword" id="keyword" class="form-control" required
                            value="{{ $data->keyword }}">
                    </div>
                    <div class="col-md-6">
                        <label for="desc">Description</label>
                        <textarea name="desc" id="desc" cols="" rows="" class="form-control" required>{{ $data->desc }}</textarea>
                    </div>

                    <div class="col-md-6">
                        <label for="image">Image</label>
                        <input type="file" name="image" id="image" class="form-control photo"
                            data-default-file="{{ asset($data->image) }}" {{ $data->image == '' ? 'required' : '' }}>
                    </div>
                    <div class="col-md-12">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" class="form-control" required>
                    </div>
                </div>
                <div class="py-2">
                    <button class="btn btn-primary">Save Meta</button>
                </div>

            </form>
        </div>
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
