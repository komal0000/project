@extends('admin.layout.app')
@section('css')
<link rel="stylesheet" href="{{asset('admin/plugins/drophify/css/dropify.min.css')}}">
<style>
    .col-md-3{
        margin-bottom:10px;
    }
</style>
@endsection
@section('page-option')
@endsection
@section('s-title')
    <li class="breadcrumb-item">
        <a href="{{route('admin.exam.index')}}">Exams</a>
    </li>
    <li class="breadcrumb-item active">
        Add
    </li>
@endsection
@section('content')

    <div class="card shadow mb-3">
        <div class="card-body">
            <form action="{{route('admin.exam.add')}}" method="post" enctype="multipart/form-data"  id="add-exam">
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <label for="academic_year_id">Academic Year</label>
                        <select name="academic_year_id" id="academic_year_id" class="form-control">
                            @foreach ($acs as $ac)
                                <option value="{{$ac->id}}">{{$ac->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" required class="form-control" required>
                    </div>
                    <div class="col-md-3">
                        <label for="start">Start Date</label>
                        <input type="date" name="start" id="start" required class="form-control" required>
                    </div>
                    <div class="col-md-3">
                        <label for="end">End Date</label>
                        <input type="date" name="end" id="end" required class="form-control" required>
                    </div>
                  
                    <div class="col-md-12 py-2">
                        <button class="btn btn-primary">Save Exam</button>

                        <a href="{{route('admin.exam.index')}}" class="btn btn-danger">Cancel</a>

                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
@section('script')
<script src="{{asset('admin/plugins/drophify/js/dropify.min.js')}}"></script>
<script>
    state=false;
    $(function () {
        $('#add-exam').submit(function (e) {
            e.preventDefault();
            checkEmail(e);

        });
    });

    function  checkEmail(e) {
        if(!state){
            e.preventDefault();
            block('#add-exam');
            let fd=new FormData(document.getElementById('add-exam'));
            axios.post('{{route('admin.exam.add')}}',fd)
            .then((res)=>{
                $('#add-exam')[0].reset();
                toastr.success('Exam Added Sucessfully.');
                unblock('#add-exam');

            })
            .catch((err)=>{
                toastr.error('Exam Not Added,Please Try Again.');
                unblock('#add-exam');

            });
        }
    }
</script>
@endsection
