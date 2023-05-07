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
        <a href="{{ route('admin.service.index', ['type' => $type]) }}">{{  $type->name }}</a>
    </li>
    <li class="breadcrumb-item active">
        Add
    </li>
@endsection
@section('content')

    <div class="card shadow mb-3">
        <div class="card-body">
            <form action="{{ route('admin.service.add', ['type' => $type]) }}" method="post" enctype="multipart/form-data"
                id="add-service">

                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <input type="file" name="logo" id="logo" class="photo" accept="image/*"  >
                    </div>
                    <div class="col-9">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" required class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="short_desc">Short Description</label>
                            <textarea name="short_desc" id="short_desc"  rows="4" class="form-control" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="desc">Description</label>
                            <textarea name="desc" id="desc"  rows="4" class="form-control desc"></textarea>
                        </div>

                        <div class="text-right">
                            <button class="btn btn-primary mr-2">Save Service</button>
                            <a href="{{route('admin.service.index',['type'=>$type->id])}}" class="btn btn-danger">Cancel</a>
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

        $(function() {
            $('.photo').dropify();
            tinymce.init({
                selector: '.desc',
                plugins: [
                    '  advlist anchor autolink codesample fullscreen help image imagetools tinydrive',
                    ' lists link media noneditable  preview',
                    ' searchreplace table template  visualblocks textcolor '
                ],
                toolbar_mode: 'floating',
                toolbar: "fontselect formatselect fontsizeselect forecolor backcolor image table visualblocks anchor  blocks",

            });
            $('#add-service').submit(function (e) {
                e.preventDefault();
                axios.post(this.action,new FormData(this))
                .then((res)=>{
                    toastr.success('Service Saved Sucessfully');
                    this.reset();
                    $(".dropify-clear").trigger('click');
                })
                .catch((err)=>{
                    toastr.error('Service Not Saved, Some Error Occured');
                });
            });
        });
    </script>
@endsection
