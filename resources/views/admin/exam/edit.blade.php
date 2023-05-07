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
     <li class="breadcrumb-item">
        <a href="{{route('admin.exam.info',['id'=>$exam->id])}}">{{$exam->name}}</a>
    </li>
    <li class="breadcrumb-item active">
        Edit
    </li>
@endsection
@section('content')

    <div class="card shadow mb-3">
        <div class="card-body">
            <form action="{{route('admin.exam.add')}}" method="post" enctype="multipart/form-data"  id="update-exam">
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <label for="academic_year_id">Academic Year</label>
                        <select name="academic_year_id" id="academic_year_id" class="form-control">
                            @foreach ($acs as $ac)
                                <option {{$ac->id==$exam->academic_year_id?'selected':''}} value="{{$ac->id}}">{{$ac->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" required class="form-control" required value="{{$exam->name}}">
                    </div>
                    <div class="col-md-3">
                        <label for="start">Start Date</label>
                        <input type="date" name="start" id="start" required class="form-control" required  value="{{$exam->start}}">
                    </div>
                    <div class="col-md-3">
                        <label for="end">End Date</label>
                        <input type="date" name="end" id="end" required class="form-control" required  value="{{$exam->end}}">
                    </div>
                  
                    <div class="col-md-12 py-2">
                        <button class="btn btn-primary">Update Exam</button>

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
        $('#update-exam').submit(function (e) {
            e.preventDefault();
            checkEmail(e);

        });
    });

    function  checkEmail(e) {
        if(!state){
            e.preventDefault();
            block('#update-exam');
            let fd=new FormData(document.getElementById('update-exam'));
            axios.post('{{route('admin.exam.update',['exam'=>$exam->id])}}',fd)
            .then((res)=>{
                // $('#update-exam')[0].reset();
                toastr.success('Exam Updated Sucessfully.');
                unblock('#update-exam');

            })
            .catch((err)=>{
                toastr.error('Exam Not Updated,Please Try Again.');
                unblock('#update-exam');

            });
        }
    }
</script>
@endsection
