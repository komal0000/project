@extends('admin.layout.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('admin/plugins/drophify/css/dropify.min.css') }}">
    <style>
        .col-md-3 {
            margin-bottom: 10px;
        }
    </style>
@endsection
@section('page-option')
@endsection
@section('s-title')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.story.index') }}"></a>
    </li>
    <li class="breadcrumb-item active">
        Add
    </li>
@endsection
@section('content')
    <div class="card shadow mb-3">
        <div class="card-body">
            <form action="{{ Route('admin.story.add', ['story' => $story->id]) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <label for="image">Image</label>
                        <input type="file" name="image" id="image" accept="image/*"
                            data-default-file="{{ asset($story->image) }}">
                    </div>
                    <div class="col-md-9">
                        <div class="mb-2">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" class="form-control"
                                value="{{ $story->title }}">
                        </div>
                        <div class="mb-2">
                            <label for="stitle">Sub-title</label>
                            <input type="text" name="stitle" id="stitle" class="form-control"
                                value="{{ $story->stitle }}">
                        </div>
                        <div class="mb-2">
                            <label for="sdesc">Short description</label>
                            <textarea type="text" name="sdesc" id="sdesc" class="form-control">{{ $story->sdesc }}</textarea>
                        </div>
                        <div class="mb-2">
                            <label for="desc">Description</label>
                            <textarea type="text" name="desc" id="desc" class="form-control">{{ $story->desc }}</textarea>
                        </div>
                        <div class="mb-2">
                            <button class="btn btn-primary">
                                Edit
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('admin/plugins/drophify/js/dropify.min.js') }}"></script>
    <script>
        state = false;
        $(function() {
            $('#image').dropify();
        });
    </script>
@endsection
