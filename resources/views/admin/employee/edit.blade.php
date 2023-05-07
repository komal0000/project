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
        <a href="{{route('admin.employee.index')}}">Employees</a>
    </li>
    <li class="breadcrumb-item ">
        {{$employee->name}}
    </li>
    <li class="breadcrumb-item active">
        Edit
    </li>
@endsection
@section('content')

    <div class="card shadow mb-3">
        <div class="card-body">
            <form action="{{route('admin.employee.update',['employee'=>$employee->id])}}" method="post" enctype="multipart/form-data" id="edit-employee">
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <input type="file" name="photo" id="photo" accept="image/*" data-default-file="{{asset($employee->photo)}}" >
                    </div>
                    <div class="col-md-12"></div>
                    <div class="col-md-3">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" required class="form-control" value="{{$employee->name}}">
                    </div>
                    <div class="col-md-3">
                            <label for="phone_no">Phone No</label>
                            <input type="tel" name="phone_no" id="phone_no" required class="form-control" value="{{$employee->phone_no}}">
                    </div>
                    <div class="col-md-3">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" required class="form-control" value="{{$employee->email}}">
                    </div>
                    <div class="col-md-3">
                        <label for="gender">Gender</label>
                        <select type="gender" name="gender" id="gender" required class="form-control">
                            @foreach ($data['gender'] as $key=>$gender)
                                <option value="{{$key}}" {{$key==$employee->gender?'selected':''}}>{{$gender}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="address">Address</label>
                        <input type="address" name="address" id="address" required class="form-control" value="{{$employee->address}}">
                    </div>
                    <div class="col-md-3">
                        <label for="dob">Date Of Birth</label>
                        <input type="date" name="dob" id="dob" required class="form-control" value="{{$employee->dob->toDateString()}}">
                    </div>
                    <div class="col-md-3">
                        <label for="shift">Shift</label>
                        <select type="shift" name="shift" id="shift" required class="form-control">
                            @foreach ($data['shift'] as $key=>$shift)
                                <option value="{{$key}}" {{$key==$employee->shift?'selected':''}}>{{$shift}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="type">Employee Type</label>
                        <select type="type" name="type" id="type" required class="form-control">
                            @foreach ($data['emp_type'] as $key=>$type)
                                <option value="{{$key}}" {{$key==$employee->type?'selected':''}}>{{$type}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="designation">Designation</label>
                        <input type="text" name="designation" id="designation"  class="form-control" value="{{$employee->designation}}">
                    </div>
                    <div class="col-md-3">
                        <label for="religion">Religion</label>
                        <select type="religion" name="religion" id="religion" required class="form-control">
                            @foreach ($data['religion'] as $key=>$type)
                                <option value="{{$key}}" {{$key==$employee->religion?'selected':''}}>{{$type}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="joining_date">Joining Date</label>
                        <input type="date" name="joining_date" id="joining_date" required class="form-control" value="{{$employee->joining_date->toDateString()}}">
                    </div>
                    <div class="col-md-12 mb-2">
                        <label for="qualification">Qualification</label>
                        <textarea name="qualification" id="qualification"  rows="4" class="form-control">{{$employee->qualification}}</textarea>
                    </div>
                    <div class="col-md-12 mb-2">
                        <label for="desc">Description</label>
                        <textarea name="desc" id="desc"  rows="4" class="form-control">{{$employee->desc}}</textarea>
                    </div>
                    <div class="col-md-6 py-2">
                        <button class="btn btn-primary">Update Employee</button>

                        <a href="{{route('admin.employee.index')}}" class="btn btn-danger">Cancel</a>

                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
@section('script')
<script src="{{asset('admin/plugins/drophify/js/dropify.min.js')}}"></script>
<script>
    var state=false;
    $(function () {
        $('#photo').dropify();
        $('#edit-employee').submit(function (e) {
            checkEmail(e);

        });
    });

    function  checkEmail(e) {
        if(!state){
            e.preventDefault();
            $('#edit-employee').block();
            axios.post('{{route('admin.email')}}',{
                'email':$('#email').val(),'emp_id':{{$employee->id}}
            })
            .then((res)=>{
                state=res.data.status<=0;
                $('#edit-employee').unblock();
                if(state){
                    $('#edit-employee').submit();
                }else{
                    alert('Email Already In Use Please Use Another Email.');
                }
            });
        }
    }
</script>
@endsection
