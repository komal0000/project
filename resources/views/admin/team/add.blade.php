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
        <a href="{{ route('admin.team.type.index') }}">Teams</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('admin.team.index', ['type' => $type]) }}">{{  $type->name }}</a>
    </li>
    <li class="breadcrumb-item active">
        Add
    </li>
@endsection
@section('content')

    <div class="card shadow mb-3">
        <div class="card-body">
            <form action="{{ route('admin.team.add', ['type' => $type]) }}" method="post" enctype="multipart/form-data"
                id="add-team">

                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <input type="file" name="image" id="image" class="photo" accept="image/*"  >
                    </div>
                    
                    <div class="col-md-12"></div>
                    <div class="col-md-6">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" required class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" required class="form-control" required>
                    </div>
                    <div class="col-md-3">
                            <label for="phone">Phone No</label>
                            <input type="tel" name="phone" id="phone" required class="form-control" required>
                    </div>
                   
                    <div class="col-md-3">
                        <label for="designation">Designation</label>
                        <input type="text" name="designation" id="designation"  class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="addr">Address</label>
                        <input type="text" name="addr" id="addr"  class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label for="fb">Facebook URL</label>
                        <input type="text" name="fb" id="fb"  class="form-control" >
                    </div>
                    <div class="col-md-4">
                        <label for="tw">Twitter URL</label>
                        <input type="text" name="tw" id="tw"  class="form-control" >
                    </div>
                    <div class="col-md-4">
                        <label for="li">Linkedin URL</label>
                        <input type="text" name="li" id="li"  class="form-control" >
                    </div>
                    <div class="col-md-12 mb-2">
                        <label for="desc">Description</label>
                        <textarea name="desc" id="desc"  rows="4" class="form-control desc"></textarea>
                    </div>
                    <div class="col-md-2">
                        <input type="number" name="SN" placeholder="SN" id="sn" min="0" class="form-control">
                    </div>
                    <div class="col-md-6 py-2">
                        <button class="btn btn-primary">Save Member</button>

                        <a href="{{route('admin.team.index',['type'=>$type->id])}}" class="btn btn-danger">Cancel</a>

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
                    ' searchreplace table template  visualblocks wordcount '
                ],
                toolbar_mode: 'floating',
              
            });
            $('#add-team').submit(function (e) { 
                e.preventDefault();
                axios.post(this.action,new FormData(this))
                .then((res)=>{
                    toastr.success('Member Saved Sucessfully');
                    this.reset();
                    $(".dropify-clear").trigger('click');
                })
                .catch((err)=>{
                    toastr.error('Member Not Saved, Some Error Occured');
                });
            });
        });
    </script>
@endsection
