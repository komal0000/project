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
        <a href="{{ route('admin.event.index')}}">Events</a>
    </li>
    <li class="breadcrumb-item active">
        Add
    </li>
@endsection
@section('content')

    <div class="card shadow mb-3">
        <div class="card-body">
            <form action="{{ route('admin.event.add') }}" method="post" enctype="multipart/form-data"
                id="add-employee">

                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <label for="photo">Feature Image</label>
                        <input type="file" required name="photo" id="photo" accept="image/*">
                    </div>
                    <div class="col-md-8">

                        <div>
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" class="form-control" required>
                        </div>
                        <div>
                            <label for="addr">Venue</label>
                            <input type="text" name="addr" id="addr" class="form-control" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                  <label for="start">Start Date</label>
                                <input type="date" name="start" id="start" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label for="end">End Date</label>
                                <input type="date" name="end" id="end" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label for="start_time">Satart Time</label>
                                <input type="time" name="start_time" id="start_time" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label for="end_time">Satart Time</label>
                                <input type="time" name="end_time" id="end_time" class="form-control" required>
                            </div>
                        
                        </div>
                        <div>
                            <label for="short_desc">Short Description</label>
                            <textarea name="short_desc" id="short_desc" cols="30" rows="10" class="form-control"
                                ></textarea>
                        </div>
                        
                        <div>
                            <label for="desc">full Description</label>
                            <textarea name="desc" id="desc" cols="30" rows="10" class="form-control desc"
                                ></textarea>
                        </div>
                        <div class="py-2">
    
                            <button class="btn btn-primary">Save Event</button>
    
                            <a href="{{ route('admin.event.index')}}"
                                class=" ms-2 btn btn-danger">Cancel</a>
                        </div>
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
       
        $(function() {
            $('#photo').dropify();
            tinymce.init({
                selector: '.desc',
                plugins: [
                    '  advlist anchor autolink codesample fullscreen help image imagetools tinydrive',
                    ' lists link media noneditable  preview',
                    ' searchreplace table template  visualblocks wordcount '
                ],
                toolbar_mode: 'floating',
              
            });
        });
    </script>
@endsection
