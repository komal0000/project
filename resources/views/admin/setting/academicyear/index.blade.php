@extends('admin.layout.app')
@section('css-include')

@endsection
@section('page-option')

@endsection
@section('s-title')
    <li class="breadcrumb-item">Setting</li>
    <li class="breadcrumb-item">Academic Year</li>
@endsection
@section('content')
    <div class="card shadow mb-3">
        <div class="card-body">
            <form action="{{route('admin.setting.academicyear.add')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" class="form-control" required>
                    </div>
                    <div class="col-md-3">
                        <label for="start_date">Start Date</label>
                        <input type="date" name="start_date" id="start_date" class="form-control" required>
                    </div>
                    <div class="col-md-3">
                        <label for="end_date">End Date</label>
                        <input type="date" name="end_date" id="end_date" class="form-control" required>
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <div>
                            <div>
                                <input type="checkbox" name="is_open_for_admission" id="is_open_for_admission" value="1"> Open For Admission
                            </div>
                            <div>
                                <input type="checkbox" name="status" id="status" value="1"> Active
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 py-2">
                        <button class="btn btn-primary w-100">Add Academic Year</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card shadow ">
        <div class="card-body">
            @foreach ($years as $year)
            <div class="card shadow mb-2" id="year-{{$year->id}}">
                <div class="card-body">
                    <form action="{{route('admin.setting.academicyear.update')}}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{$year->id}}">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="title">Title</label>
                                <input type="text" name="title" id="title" class="form-control" required value="{{$year->title}}">
                            </div>
                            <div class="col-md-3">
                                <label for="start_date">Start Date</label>
                                <input type="date" name="start_date" id="start_date" class="form-control" required value="{{$year->start_date->toDateString()}}">
                            </div>
                            <div class="col-md-3">
                                <label for="end_date">End Date</label>
                                <input type="date" name="end_date" id="end_date" class="form-control" required value="{{$year->end_date->toDateString()}}">
                            </div>
                            <div class="col-md-3 d-flex align-items-end">
                                <div>
                                    <div>
                                        <input type="checkbox" name="is_open_for_admission" id="is_open_for_admission" value="1" {{$year->is_open_for_admission==1?'checked':''}}> Open For Admission
                                    </div>
                                    <div>
                                        <input type="checkbox" name="status" id="status" value="1" {{$year->status==1?'checked':''}}> Active
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 py-2">
                                <button class="btn btn-primary w-100">Update Academic Year</button>
                            </div>
                            <div class="col-md-3 py-2">
                                <span onclick="del({{$year->id}})" class="btn btn-danger w-100">Delete Academic Year</span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection
@section('script')
    <script>
        function del(id){
            if(confirm('Do You Want to Delete Academic Year?')){
                $('body').block();
                axios.post('{{route('admin.setting.academicyear.delete')}}',{id:id})
                .then((res)=>{
                    if(res.data.status){
                        $('#year-'+id).remove();
                        toastr.success('Academic Year Added SucessFully');
                    }else{
                        toastr.error('Academic Year Cannot Be Deleted, '+res.data.message);
                    }
                    $('body').unblock();

                })
                .catch((err)=>{
                    toastr.error('Academic Year Could Not Be Deleted.Please Try Again.');
                    $('body').unblock();
                });
            }
        }
    </script>
@endsection
